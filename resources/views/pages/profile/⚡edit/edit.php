<?php

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Component;

new class extends Component {
    use PasswordValidationRules;

    public $user;
    public string $first_name = '';
    public string $last_name = '';
    public string $email= '' ;
    public string $phone ='';
    public string $profile_image= '';
    public string $password = '';
    public string $password_confirmation = '';

    public function mount(User $user): void
    {
        $this->user = \Auth::user();
        $this->first_name = $this->user->first_name;
        $this->last_name = $this->user->last_name;
        $this->email = $this->user->email;
        $this->phone = $this->user->phone ?? '';
        $this->profile_image = $this->user->profile_image;
    }

    public function save(): void
    {
        $validated_data = $this->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'string|required|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->user->id)],
            'phone' => 'required|string',
            'profile_image' => 'nullable|string',
            'password'=>$this->updatePasswordRules(),
        ]);

        $this->user->update([
            'first_name' => $validated_data['first_name'],
            'last_name' => $validated_data['last_name'],
            'email' => $validated_data['email'],
            'phone' => $validated_data['phone'],
            'profile_image' => $validated_data['profile_image'],
            'password'=>Hash::make($validated_data['password']),
        ]);

        $this->redirect(route('pages::profile.index', ['locale' => app()->getLocale(), 'volunteer'=>$this->user]));
    }

    public function render()
    {
        return view('pages.profile.⚡edit.edit')->title(__('general.profile-edit'));
    }
};
