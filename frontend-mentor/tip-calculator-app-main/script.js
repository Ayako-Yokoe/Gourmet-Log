let billAmount = 0;
let tip = 0;
let numOfPeople = 1;
let tipAmount = 0;
let totalAmount = 0;

document.getElementById("tip-amount").innerText = "0.00";
document.getElementById("total").innerText = "0.00";

const tipButtons = document.querySelectorAll(".select-tip-container button");
const customInput = document.getElementById("custom-input");
const customBtn = document.getElementById("custom-btn");
const resetBtn = document.getElementById("reset-btn");

const bill = document.getElementById("bill-input");
const people = document.getElementById("people-input");
const peopleErrorMessage = document.getElementById("people-error-message");
const peopleWrapper = document.querySelector(".people-section .input-wrapper");
const tipAmountInput = document.getElementById("tip-amount");
const totalInput = document.getElementById("total");

function updateCalculations(bill, tip, numOfPeople) {
    calculateTipAmount(bill, tip, numOfPeople);
    calculateTotal(bill, tip, numOfPeople);
}

function sanitizeInput(inputElement, inputValue) {
    const cursorPosition = inputElement.selectionStart;

    let rawValue = inputValue;

    let sanitizedValue = rawValue.replace(/[^0-9.]/g, "");

    if (rawValue.indexOf(".") === -1) {
        sanitizedValue = sanitizedValue.replace(/^0+(?=\d)/, "");
    }

    if (sanitizedValue === ".") sanitizedValue = "0.";

    inputElement.value = sanitizedValue;

    inputElement.setSelectionRange(cursorPosition, cursorPosition);

    sanitizedValue = parseFloat(sanitizedValue) || 0;

    return sanitizedValue;
}

bill.addEventListener("input", (e) => {
    let billAmount = sanitizeInput(e.target, e.target.value);
    updateCalculations(billAmount, tip, numOfPeople);
});

people.addEventListener("input", (e) => {
    e.target.value = e.target.value.replace(/^0+/, "");
    numOfPeople = Number(e.target.value);

    if (numOfPeople === 0 || e.target.value === "") {
        peopleErrorMessage.style.display = "block";
        peopleWrapper.classList.add("error");
        peopleWrapper.classList.remove("success");
    } else {
        peopleErrorMessage.style.display = "none";
        peopleWrapper.classList.remove("error");
        peopleWrapper.classList.add("success");
    }

    updateCalculations(billAmount, tip, numOfPeople);
});

function calculateTipAmount(bill, tip, numOfPeople) {
    tipAmount = 0;
    if (tip !== 0) {
        tipAmount = bill * (tip / 100);
    }

    if (numOfPeople === 0) {
        numOfPeople = 1;
    }

    tipAmount = tipAmount / numOfPeople;
    tipAmount = Math.round(tipAmount * 100) / 100;
    tipAmountInput.innerText = tipAmount.toFixed(2);
}

function calculateTotal(bill, tip, numOfPeople) {
    tipAmount = 0;
    totalAmount = 0;
    if (tip !== 0) {
        tipAmount = bill * (tip / 100);
    }

    if (numOfPeople === 0) {
        numOfPeople = 1;
    }

    totalAmount = (bill + tipAmount) / numOfPeople;
    totalAmount = Math.round(totalAmount * 100) / 100;
    totalInput.innerText = totalAmount.toFixed(2);
}

function enableReset() {
    resetBtn.disabled = false;
    resetBtn.classList.add("enabled");
}

function handleTipButtonClick(e) {
    tipButtons.forEach((tipButton) => {
        tipButton.classList.remove("active-btn");
    });

    let clickedBtn = e.target;
    clickedBtn.classList.add("active-btn");

    tip = parseInt(clickedBtn.getAttribute("data-tip"), 10);

    updateCalculations(billAmount, tip, numOfPeople);

    enableReset();
}

tipButtons.forEach((tipBtn) => {
    tipBtn.addEventListener("click", handleTipButtonClick);
});

customBtn.addEventListener("click", (e) => {
    tip = parseInt(e.target.getAttribute("data-tip"), 10);
    updateCalculations(billAmount, tip, numOfPeople);

    customInput.style.display = "inline-block";
    customInput.focus();
    customBtn.style.display = "none";

    customInput.addEventListener("input", (e) => {
        e.target.value = e.target.value.replace(/^0+/, "");

        if (e.target.value === "" || isNaN(Number(e.target.value))) {
            tip = 0;
        } else {
            tip = Number(e.target.value);
        }

        let validBillAmount = billAmount || 0;
        let validNumOfPeople = numOfPeople || 1;

        updateCalculations(validBillAmount, tip, validNumOfPeople);
    });

    enableReset();
});

[bill, people].forEach((element) => {
    element.addEventListener("input", enableReset);
});

if (customInput) {
    customInput.addEventListener("input", enableReset);
}

[...document.querySelectorAll("ul li button")].forEach((button) => {
    button.addEventListener("click", enableReset);
});

resetBtn.addEventListener("click", () => {
    billAmount = 0;
    tip = 0;
    numOfPeople = 1;
    bill.value = "";
    people.value = "";
    tipAmountInput.innerText = "0.00";
    totalInput.innerText = "0.00";

    if (customInput.value) {
        customInput.value = "";
    }

    customInput.style.display = "none";
    customBtn.style.display = "inline-block";

    resetBtn.disabled = true;
    resetBtn.classList.remove("enabled");

    tipButtons.forEach((resetBtn) => {
        resetBtn.classList.remove("active-btn");
    });

    customInput.removeEventListener("input", (e) => {
        tip = Number(e.target.value);
        updateCalculations(billAmount, tip, numOfPeople);
    });
});
