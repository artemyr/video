<div x-data='@json([
            'edit' => $editMode ? '?edit=n' : '?edit=y'
        ])'
     x-on:click="location.href = location.origin + location.pathname + edit"
     class="cursor-pointer fixed right-10 bottom-10 bg-alert hover:bg-red text-white rounded-full p-4"
>
    @if($editMode)
        edit-mode off
    @else
        edit-mode on
    @endif
</div>
