<dl class= "days-times max-w-web flex-j-c-start phone-flex">
    <div>
        <dt class="field__label" wire="monday">
            {{__('admin/volunteers.monday')}}
        </dt>
        <dd class="availability-input t-a-center min-w-130" name="monday" id="monday" wire="monday">
            {{ $availabilities->monday??'/' }}
        </dd>
    </div>

    <div>
        <dt class="field__label" wire="tuesday">
            {{__('admin/volunteers.tuesday')}}
        </dt>
        <dd class="availability-input t-a-center min-w-130" name="tuesday" id="tuesday" wire="tuesday">
            {{ $availabilities->tuesday??'/' }}
        </dd>
    </div>
    <div>
        <dt class="field__label" wire="wednesday">
            {{__('admin/volunteers.wednesday')}}
        </dt>
        <dd class="availability-input t-a-center min-w-130" name="wednesday" id="wednesday" wire="wednesday">
            {{ $availabilities->wednesday??'/' }}
        </dd>
    </div>
    <div>
        <dt class="field__label" wire="thursday">
            {{__('admin/volunteers.thursday')}}
        </dt>
        <dd class="availability-input t-a-center min-w-130" name="thursday" id="thursday" wire="thursday">
            {{ $availabilities->thursday??'/' }}
        </dd>
    </div>
    <div>
        <dt class="field__label" wire="friday">
            {{__('admin/volunteers.friday')}}
        </dt>
        <dd class="availability-input t-a-center min-w-130" name="friday" id="friday" wire="friday">
            {{ $availabilities->friday??'/' }}
        </dd>
    </div>
    <div>
        <dt class="field__label">
            {{__('admin/volunteers.saturday')}}
        </dt>
        <dd class="availability-input t-a-center min-w-130" name="saturday" id="saturday" wire="saturday">
            {{ $availabilities->saturday??'/' }}
        </dd>
    </div>
    <div>
        <dt class="field__label">
            {{__('admin/volunteers.sunday')}}
        </dt>
        <dd class="availability-input t-a-center min-w-130" name="sunday" id="sunday" wire="sunday">
            {{ $availabilities->sunday??'/' }}
        </dd>
    </div>
</dl>
