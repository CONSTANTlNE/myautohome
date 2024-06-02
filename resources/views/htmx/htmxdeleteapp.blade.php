<form >
<input type="hidden" name="id" value="{{$application->id}}">
@csrf
    <p class="text-center mb-5">ნამდვილად გსურთ განაცხადის წაშლა?</p>

    <button
            data-hs-overlay="#delete"
            type="button"
            hx-post="{{route('app.htmx.destroy')}}"
            hx-target="#main-content"
            hx-target-error="#errors"
            hx-indicator="#indicator"
            class="ti-btn ti-btn-primary-full ti-btn-wave">წაშლა
    </button>
</form>