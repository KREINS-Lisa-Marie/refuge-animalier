<main class="main-container" id="content">
    <x-page-bar>
        {{__('admin/profile.profile')}}
    </x-page-bar>

    <section class="profile-information max-w-admin-web">
        <h2 class="sro" aria-level="2">
            {{__('admin/profile.form')}}
        </h2>

    <form wire:submit="save" class="profile-form">
        @csrf
        <div class="form-fields">
            <x-fields.text id="firstname" name="firstname" value=" {!! $user->first_name !!}" placeholder="Ex: John" wire="first_name">
                {{__('admin/profile.firstname')}}
            </x-fields.text>
            <x-fields.text id="lastname" name="lastname" value=" {!! $user->last_name !!}" placeholder="Ex: Doe" wire="last_name">
                {{__('admin/profile.lastname')}}
            </x-fields.text>
            <x-fields.email id="useremail" name="useremail" value=" {!! $user->email !!}" placeholder="Ex: john@doe.com" wire="email">
                {{__('admin/profile.email')}}
            </x-fields.email>
            <x-fields.phone id="phone" name="phone" value=" {!! $user->phone !!}" placeholder="Ex: 038438293" wire="phone">
                {{__('admin/profile.phone_number')}}
            </x-fields.phone>
            <x-fields.password value="" wire="password">
                {{__('admin/profile.password')}}
            </x-fields.password>
            <x-fields.password-confirmation value="" wire="password_confirmation">
                {{__('admin/profile.password_confirmation')}}
            </x-fields.password-confirmation>
            <x-fields.file name_id="" wire="image" name="">
                {{__('admin/profile.image')}}
            </x-fields.file>
        </div>
        <x-admin.form-button>
            {{__('admin/profile.save')}}
        </x-admin.form-button>
    </form>
</section>
</main>
