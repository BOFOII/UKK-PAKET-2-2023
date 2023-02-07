@guest
    {{-- TODO --}}
@else
    {{-- LOGOUT v1 --}}
    <form action="{{ route('logout-petugas') }}" method="POST">
        @method('DELETE')
        @csrf
        <button class="btn btn-primary" type="submit">Logout V1</button>
    </form>

    {{-- LOGOUT V2 --}}
    <form id="logout-form" action="{{ route('logout-petugas') }}" method="POST">
        @method('DELETE')
        @csrf
    </form>
    <button onclick="document.getElementById('logout-form').submit();" id="logout-btn" class="btn btn-primary">Logout
        v2</button>
    {{-- END LOGOUT V2 --}}
@endguest
