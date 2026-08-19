<main class="main-container profile-index" id="content">
    <x-page-bar>
        {{__('admin/profile.profile')}}
    </x-page-bar>

    <section class="profile-information max-w-admin-web">
        <h2 class="sro" aria-level="2">
            {{__('admin/profile.form')}}
        </h2>

    <form wire:submit.prevent="save" class="profile-form" enctype="multipart/form-data">
        @csrf
        <fieldset>
            <legend class="fw-700 admin-dashboard-title">
                {{__('admin/profile.change_my_data')}}
            </legend>
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
            <div>
            @if($user->profile_image)
                <div class="profile-edit-img m-b-16">
                    <img src="{{Storage::disk('s3')->url('images/users/variants/300x300/'.basename($user->profile_image))}}" alt="{{__('admin/volunteers.profile_image')}}"
                         class="border-r-small profile-img">
                    <p class="fw-medium">{{__('admin/profile.current_image')}}</p>
                    <p class="fw-medium">{{__('admin/profile.changeable_image')}}</p>
                </div>
            @endif
            <x-fields.file name_id="profile_image" wire="profile_image" name="profile_image">
                {{__('admin/profile.image')}}
            </x-fields.file>
            </div>
        </div>
        <x-admin.form-button>
            {{__('admin/profile.save')}}
        </x-admin.form-button>
            </fieldset>
    </form>
        <form wire:submit.prevent="updatePassword" class="profile-form profile-pw-form m-t-56 d-flex flex-gap-32 flex-dir">
            @csrf
            <fieldset>
                <legend class="fw-700 admin-dashboard-title">
                    {{__('admin/profile.change_my_password')}}
                </legend>
            <x-fields.password value="" wire="password">
                {{__('admin/profile.password')}}
            </x-fields.password>
            <x-fields.password-confirmation value="" wire="password_confirmation">
                {{__('admin/profile.password_confirmation')}}
            </x-fields.password-confirmation>
            <x-admin.form-button>
                {{__('admin/profile.save')}}
            </x-admin.form-button>
            </fieldset>
        </form>
</section>
</main>
