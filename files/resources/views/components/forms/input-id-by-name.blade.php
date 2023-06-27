<div x-data="{
    sources: {{ $sources }},
    selectedName: '{{ $selectedName }}',
    selectedId: {{ $selectedId }},
    setId() {
        const selectedSource = this.sources.find(source => source.name == this.selectedName);
        this.selectedId = selectedSource ? selectedSource.id : null;
        }
    }">
    <x-forms.input type="text"
                   name="{{ $inputFieldName ?? '' }}"
                   list="{{ $dataListId ?? 'sources' }}"
                   x-model="selectedName"
                   @input="setId()"
                   placeholder="{{ $placeholder ?? '' }}"
                   required />
    <input type="hidden"
           name="{{ $hiddenFieldName }}"
           x-model="selectedId" />
    <datalist id="{{ $dataListId ?? 'sources' }}">
        <template x-for="source in sources">
            <option :value="source.name"></option>
        </template>
    </datalist>
</div>
