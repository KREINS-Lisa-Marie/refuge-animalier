<?php

use App\Models\Request;
use Livewire\Attributes\Layout;
use Livewire\Component;

new class extends Component
{
    public string $first_name = '';
    public string $last_name = '';
    public string $email= '';
    public string $phone= '';
    public string $address= '';

    public string $animal_id= '';
    public string $state= '';
    public string $comment= '';
    public Request $request;


    public string $date= '';
    public string $message= '';

    public function mount(Request $request): void
    {
        $this->request = $request;
        $this->first_name = $request->first_name ?? '';
        $this->last_name = $request->last_name  ?? '';
        $this->email = $request->email ?? '';
        $this->phone = $request->phone  ?? '';
        $this->address = $request->address  ?? '';
        $this->animal_id = $request->animal_id  ?? '';
        $this->message = $request->message  ?? '';
        $this->state = $request->state  ?? '';
        $this->comment = $request->comment  ?? '';
    }

    public function save(): void
    {
        $validated_data = $this->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'string|required|max:255',
            'email' => ['required', 'string', 'email', 'max:255'],
            'animal_id' => 'required|string',
            'phone' => 'required|string|max:255',
            'address' => 'max:255|string',
            'state' => 'string|max:255',
            'comment' => 'string|max:255',

        ]);


        $this->request->update([
            'first_name' => $validated_data['first_name'],
            'last_name' => $validated_data['last_name'],
            'email' => $validated_data['email'],
            'phone' => $validated_data['phone'],
            'animal_id' => $validated_data['animal_id'],
            'address' => $validated_data['address'],
            'message' => $this->request->message,
            'state' => $validated_data['state'],
            'comment' => $this->request->comment,
        ]);

        $this->redirect(route('pages::adoption-requests.index', ['locale' => app()->getLocale(), 'request'=>$this->request]));
    }

    public function render()
    {
        return view('pages.adoption-requests.⚡edit.edit')->title(__('general.adoption-requests_edit'));
    }
};
