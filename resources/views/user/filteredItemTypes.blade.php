<form action="{{ route('get.filtered.products') }}" id="filter" method="POST">
  @csrf
  @foreach($itemtypes as $itemtype)
    <li>
      <input id="{{ $itemtype->id }}" class="styled" type="checkbox" name="{{ $itemtype->id }}" checked>
      <label for="{{ $itemtype->id }}"> {{ $itemtype->item_type }} </label>
    </li>
  @endforeach
  <input type="submit" id="filtersubmit" style="display:none">
</form>