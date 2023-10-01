<?php

namespace App\Http\Livewire\Components\Notifications;

use Illuminate\Notifications\DatabaseNotification;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class Notifications extends Component
{
    public $notificationId;

    public function goToSingleSav($savId)
    {
        return redirect()->route('sav.single', ['id' => $savId]);
    }
    public function markNotificationAsRead($notificationId)
    {
        $this->notificationId = $notificationId;
        $notification = DatabaseNotification::findOrFail($this->notificationId);
        $notification->markAsRead();
    }
    public function render()
    {
        return view('livewire.components.notifications.notifications');
    }
}
