<?php

use App\Models\Request;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Component;

new class extends Component
{
    public string $first_name = '';
    public string $last_name = '';
    public string $email = '';
    public string $phone = '';
    public string $address = '';

    public string $animal_id = '';
    public string $message = '';
    public string $state = '';
    public string $comment = '';
    public string $date = '';

    public function save(): void
    {
        $validated_data = $this->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'string|required|max:255',
            'email' => ['required', 'string', 'email', 'max:255'],
            'animal_id' => 'required|string',
            'phone' => 'required|string|max:255',
            'address' => 'max:255|string',
            'message' => 'string|max:255',
            'state' => 'string|max:255',
            'comment' => 'string|max:255',

        ]);


        $adoption_request = Request::create([
            'first_name' => $validated_data['first_name'],
            'last_name' => $validated_data['last_name'],
            'email' => $validated_data['email'],
            'phone' => $validated_data['phone'],
            'animal_id' => $validated_data['animal_id'],
            'address' => $validated_data['address'],
            'message' => $validated_data['message'],
            'state' => $validated_data['state'],
            'comment' => $validated_data['comment'],
            'date' => Carbon::now(),
        ]);


        $this->redirect(route('pages::adoption-requests.index', ['locale' => __('general.currentLocale')]));
    }






};
