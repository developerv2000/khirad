<form class="extensive-search" method="GET" action="{{ route('search') }}">
    <select class="jq-select extensive-search__select extensive-search__categories" name="category_id">
        <option value="all">Ҳамаи дастабандиҳо</option>
        @foreach ($categories as $category)
            <option value="{{$category->id}}">{{$category->title}}</option>
        @endforeach
    </select>

    <select class="jq-select extensive-search__select extensive-search__year" name="publish_year">
        <option value="all">Сол</option>
        @for($i = date('Y'); $i >= 1950; $i--)
            <option value="{{ $i }}">{{ $i }}</option>
        @endfor
    </select>

    <input class="extensive-search__input" name="keyword" type="text" placeholder="Ҷӯстуҷӯ..."/>

    <button class="extensive-search__button button button--main" type="submit">Ҷустуҷӯ</button>
</form>  {{-- Extensive search end --}}