<label for="search" class="sro">
    {{__('general.search')}}
</label>
<input type="text" name="search" id="search" class="background-white border-r-big admin-search" {{-- value="{{/*$old || */}}"--}} placeholder="{{__('general.searching')}}" wire:model.live.debounce.300ms="term">
