<?php

namespace App\Livewire;

use App\Models\Review;
use Livewire\Component;
use Livewire\WithPagination;

class Posts extends Component
{
    use WithPagination;

    public string $title;
    public ?int $postId;
    public bool $isEdit = false;
    public bool $popUp = false;

    public function render()
    {
        return view('livewire.list', [
            'posts' => Review::latest()->paginate(5),
        ]);
    }

    public function resetInputFields()
    {
        $this->title = '';
        $this->postId = null;
        $this->isEdit = false;
        $this->popUp = false;
    }

    public function store()
    {
        $this->validate([
            'title' => 'required',
        ]);

        Review::create([
            'title' => $this->title,
            'image' => ''
        ]);

        session()->flash('message', 'Post Created Successfully.');

        $this->resetInputFields();
    }

    public function edit($id)
    {
        $post = Review::findOrFail($id);
        $this->postId = $post->id;
        $this->title = $post->title;
        $this->isEdit = true;
        $this->popUp = true;
    }

    public function add()
    {
        $this->postId = null;
        $this->title = '';
        $this->isEdit = false;
        $this->popUp = true;
    }

    public function update()
    {
        $this->validate([
            'title' => 'required',
        ]);

        if ($this->postId) {
            $post = Review::find($this->postId);
            $post->update([
                'title' => $this->title,
            ]);
            session()->flash('message', 'Post Updated Successfully.');
            $this->resetInputFields();
        }
    }

    public function delete($id)
    {
        Review::find($id)->delete();
        session()->flash('message', 'Post Deleted Successfully.');
    }
}
