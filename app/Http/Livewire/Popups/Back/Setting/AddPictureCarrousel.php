<?php

namespace App\Http\Livewire\Popups\Back\Setting;

use App\Models\CarrouselHome;
use App\Models\Media;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class AddPictureCarrousel extends ModalComponent
{
    use WithFileUploads;
    public $key, $cover;

    protected $rules = [
        'key' => 'required|unique:carrousel_homes,key',
        'cover' => 'required',
    ];
    protected $messages = [
        'key.required' => "La clé est obligatoire.",
        'key.unique' => "Cette clé est déjà utilisée.",
        'cover.required' => "L'image est obligatoire.",
    ];

    public function updated($key)
    {
        $this->validateOnly($key);
    }

    public function create()
    {
        $this->validate();

        $media = new Media;
        $media->fichier_image = 'main-carousel-'.str_replace(view()->shared('characters'), view()->shared('correct_characters'), strtolower($this->key)).'.'.$this->cover->extension();
        $media->key = 'main-carousel-'.str_replace(view()->shared('characters'), view()->shared('correct_characters'), strtolower($this->key));
        $media->alt = 'main-carousel-'.$this->key;
        $media->save();

        $carousel = new CarrouselHome;
        $carousel->key = strtoupper($this->key);
        $carousel->media_id = $media->id;
        if($carousel->save()) {
            $this->cover->storeAs('public/medias', 'main-carousel-'.str_replace(view()->shared('characters'), view()->shared('correct_characters'), strtolower($this->key)). '.' . $this->cover->extension());
            return redirect()->route('back.setting');
        }
    }

    public function render()
    {
        return view('livewire.popups.back.setting.add-picture-carrousel');
    }
}
