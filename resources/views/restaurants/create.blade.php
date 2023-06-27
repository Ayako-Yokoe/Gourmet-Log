@extends('components.layout')

@section('main')


<div>
    <h1>Create/Edit Restaurant</h1>

    <div>
        <form method="POST" action="/restaurants">
            @csrf

            <div>
                <label for="name">Name of Restaurant</label><br>
                <input type="text" name="name" />
            </div>

            <div>
                <label for="name_katakana">Name of Restaurant Furigana</label><br>
                <input type="text" name="name_katakana" />
            </div>

            <div>
                <span>Category</span>
                <input type="checkbox" name="category1" value="Japanese" />
                <label for="category1">Japanese</label>
                <input type="checkbox" name="category2" value="Chinese" />
                <label for="category2">Chinese</label>
                <input type="checkbox" name="category3" value="French" />
                <label for="category3">French</label>
            </div>

            <div>
                <label for="review">Review (Max: 5/ Min: 1)</label>
                <select name="review">
                    <option value="" selected></option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>

            <div>
                <label>Photo of Food</label>
                <input type="file" />
            </div>

            <div>
                <label for="url">Google Map URL</label>
                <input type="url" name="url" />
            </div>

            <div>
                <label for="phone_number">Phone Number</label>
                <input type="tel" name="phone_number" />
            </div>

            <div>
                <label for="comment">Comment</label>
                <input type="text" name="comment" />
            </div>

            <button type="submit">Confirmation Page</button>
        </form>
    </div>

    

</div>
    
@endsection
