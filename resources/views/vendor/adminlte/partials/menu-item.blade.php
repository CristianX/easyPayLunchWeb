
@if (is_string($item))
  <!-- div user panel Incluido para mostrar el nombre de usuario y la imagen de este -->
  <div class="user-panel">
        <div class="pull-left image">
          <img src="../dist/img/{{ Auth::user()->avatar }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>La Esquina</p>
          <a href="perfil"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

    <li class="header">{{ $item }}</li>
@else
    <li class="{{ $item['class'] }}">
        <a href="{{ $item['href'] }}" @if (isset($item['target'])) target="{{ $item['target'] }}" @endif>
            <i class="fa fa-fw fa-{{ isset($item['icon']) ? $item['icon'] : 'circle-o' }} {{ isset($item['icon_color']) ? 'text-' . $item['icon_color'] : '' }}"></i>
            <span>{{ $item['text'] }}</span>
            @if (isset($item['label']))
                <span class="pull-right-container">
                    <span class="label label-{{ isset($item['label_color']) ? $item['label_color'] : 'primary' }} pull-right">{{ $item['label'] }}</span>
                </span>
            @elseif (isset($item['submenu']))
                <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
            @endif
        </a>
        @if (isset($item['submenu']))
            <ul class="{{ $item['submenu_class'] }}">
                @each('adminlte::partials.menu-item', $item['submenu'], 'item')
            </ul>
        @endif
    </li>


@endif
