<?php

use App\Models\Availability;
use App\Models\User;
use Livewire\Component;
use Illuminate\Validation\Rule;

new class extends Component
{
    public User $volunteer;
    public ?Availability $availabilities;

    public string $first_name ;
    public string $last_name ;
    public string $email ;
    public string $phone ;
    public string $profile_image ;
    public string $is_admin;
    public string $password;
    public string $password_confirmation ;
    public string $monday ;
    public string $tuesday ;
    public string $wednesday ;
    public string $thursday ;
    public string $friday;
    public string $saturday;
    public string $sunday;

    public function mount(User $volunteer): void
    {
        $this->volunteer = $volunteer;
        $this->availabilities = Availability::where('user_id', $volunteer->id)->first();
        $this->first_name = $volunteer->first_name;
        $this->last_name = $volunteer->last_name;
        $this->email = $volunteer->email;
        $this->phone = $volunteer->phone ?? '';
        $this->profile_image = $volunteer->profile_image;
        $this->is_admin = $volunteer->is_admin ? '1' : '0';
        $this->monday = $this->availabilities->monday ?? '';
        $this->tuesday = $this->availabilities->tuesday ?? '';
        $this->wednesday = $this->availabilities->wednesday ?? '';
        $this->thursday = $this->availabilities->thursday ?? '';
        $this->friday = $this->availabilities->friday ?? '';
        $this->saturday = $this->availabilities->saturday ?? '';
        $this->sunday = $this->availabilities->sunday ?? '';
    }

    public function save(): void
    {
        $validated_data = $this->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'string|required|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->volunteer->id)],
            'phone' => 'required|string',
            'profile_image' => 'nullable|string',
            'is_admin' => 'required|string',
            'monday' => 'string|nullable',
            'tuesday' => 'string|nullable',
            'wednesday' => 'string|nullable',
            'thursday' => 'string|nullable',
            'friday' => 'string|nullable',
            'saturday' => 'string|nullable',
            'sunday' => 'string|nullable',
        ]);



         $this->volunteer->update([
            'first_name' => $validated_data['first_name'],
            'last_name' => $validated_data['last_name'],
            'email' => $validated_data['email'],
            'phone' => $validated_data['phone'],
            'profile_image' => $validated_data['profile_image'],
             'is_admin' => $validated_data['is_admin'] === '1'      //si = 1 alors = true sinon false
        ]);

        //dd($validated_data['is_admin']);

        Availability::updateOrCreate(
            ['user_id' => $this->volunteer->id],
            [
                'monday' =>  $validated_data['monday'],
            'tuesday' =>  $validated_data['tuesday'],
            'wednesday' =>  $validated_data['wednesday'],
            'thursday' =>  $validated_data['thursday'],
            'friday' =>  $validated_data['friday'],
            'saturday' =>  $validated_data['saturday'],
            'sunday' =>  $validated_data['sunday'],
            ],
             );

        $this->redirect(route('pages::volunteers.show', ['locale' => app()->getLocale(), 'volunteer'=>$this->volunteer]));
}

    public function render()
    {
        return view('pages.volunteers.⚡edit.edit')->title(__('general.volunteers_edit'));
    }
};
