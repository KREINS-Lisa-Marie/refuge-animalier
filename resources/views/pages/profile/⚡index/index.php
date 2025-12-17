<?php

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.dashboard')] class extends Component
{
    public function mount(): void
    {

    }

    public function destroy(): \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        $user= Auth::user();
        $user->delete();

        return redirect(route('login'));
    }
};
