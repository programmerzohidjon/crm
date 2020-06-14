@foreach($menus as $menu)
  @if($menu->child->where('status',1)->count())
    <li class="treeview">
      <a href="@if(\Route::has($menu->url)){{route($menu->url)}} @else # @endif">
        <i class="{{$menu->icon}}"></i> <span>{{$menu->name}}</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        @foreach($menu->child as $submenu)
        <li>
          <a href="@if(\Route::has($submenu->url)){{route($submenu->url)}} @else # @endif">
            <i class="{{$submenu->icon}}"></i>
            <span>{{$submenu->name}}</span>
          </a>
        </li>
        @endforeach
      </ul>
    </li>
    @else
    <li><a href="@if(\Route::has($menu->url)){{route($menu->url)}} @else # @endif">
      <i class="{{$menu->icon}}"></i> <span>{{$menu->name}}</span></a>
        </li>
  @endif
@endforeach
<li><a href="#"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
<li class="header">LABELS</li>