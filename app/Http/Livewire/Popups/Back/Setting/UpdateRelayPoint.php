<?php

namespace App\Http\Livewire\Popups\Back\Setting;

use LivewireUI\Modal\ModalComponent;
use App\Models\RelaisPoint;

class UpdateRelayPoint extends ModalComponent
{
    public $nameRelayPoint;
    public $adressRelayPoint;
    public $openingHours;
    public $availableRelayPoint;
    public $conctactPhone;
    public $conctactEmail;
    public $relayPointId;

    public function mount($id)
    {

        $this->relayPointId = $id;
        $selectedRelayPoint = RelaisPoint::where('id', $this->relayPointId)->first();
        $this->nameRelayPoint = $selectedRelayPoint->name;
        $this->adressRelayPoint = $selectedRelayPoint->address;
        $this->openingHours = $selectedRelayPoint->opening_hours;
        $this->availableRelayPoint = $selectedRelayPoint->available;
        $this->conctactPhone = $selectedRelayPoint->contact_phone;
        $this->conctactEmail = $selectedRelayPoint->contact_email;
    }

    public function updateRelayPoint()
    {
        $this->validate([
            'nameRelayPoint' => 'required|string|max:50',
            'adressRelayPoint' => 'required|string|max:50',
            'openingHours' => 'required|string',
            'availableRelayPoint' => 'required|boolean',
            'conctactPhone' => 'required|string',
            'conctactEmail' => 'required|email',
        ]);
    
        try {
            $selectedRelayPoint = RelaisPoint::where('id', $this->relayPointId)->first();
    
            if ($selectedRelayPoint) {
                $selectedRelayPoint->name = $this->nameRelayPoint;
                $selectedRelayPoint->address = $this->adressRelayPoint;
                $selectedRelayPoint->opening_hours = $this->openingHours;
                $selectedRelayPoint->available = $this->availableRelayPoint;
                $selectedRelayPoint->contact_phone = $this->conctactPhone;
                $selectedRelayPoint->contact_email = $this->conctactEmail;
    
                $selectedRelayPoint->save();
    
                session()->flash('success', 'Relay point updated successfully.');
    
                $this->emit('relayPointUpdated');
            } else {
                session()->flash('error', 'Relay point not found.');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred: ' . $e->getMessage());
        }
    
        return redirect()->back();
    }   

    public function render()
    {
        return view('livewire.popups.back.setting.update-relay-point');
    }
}
