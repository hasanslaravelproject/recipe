@php $editing = isset($user) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="name"
            label="Name"
            value="{{ old('name', ($editing ? $user->name : '')) }}"
            maxlength="255"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.email
            name="email"
            label="Email"
            value="{{ old('email', ($editing ? $user->email : '')) }}"
            maxlength="255"
            required
        ></x-inputs.email>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.password
            name="password"
            label="Password"
            maxlength="255"
            :required="!$editing"
        ></x-inputs.password>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <div x-data="imageComponentData()">
            <x-inputs.partials.label
                name="image"
                label="Image"
            ></x-inputs.partials.label
            ><br />

            <img
                :src="imageDataUrl"
                style="object-fit: cover; width: 150px; height: 150px; border: 1px solid #ccc; border-radius: 0.25rem !important;"
            />

            <div class="mt-2">
                <input
                    type="file"
                    name="image"
                    id="image"
                    @change="fileChanged"
                />
            </div>

            @error('image') @include('components.inputs.partials.error')
            @enderror
        </div>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="company_id" label="Company Id">
            @php $selected = old('company_id', ($editing ? $user->company_id : '')) @endphp
        </x-inputs.select>
    </x-inputs.group>

    <div class="form-group col-sm-12 mt-4">
        <h4>Assign @lang('crud.roles.name')</h4>

        @foreach ($roles as $role)
        <div>
            <x-inputs.checkbox
                id="role{{ $role->id }}"
                name="roles[]"
                label="{{ ucfirst($role->name) }}"
                value="{{ $role->id }}"
                :checked="isset($user) ? $user->hasRole($role) : false"
                :add-hidden-value="false"
            ></x-inputs.checkbox>
        </div>
        @endforeach
    </div>
</div>

@push('scripts')
<script>

    /* Alpine component for image uploader viewer */
    function imageComponentData() {
        return {
            imageDataUrl: '{{ $editing && $user->image ? \Storage::url($user->image) : '' }}',

            fileChanged(event) {
                fileToDataUrl(event, src => this.imageDataUrl = src)
            }
        }
    }
</script>
@endpush
