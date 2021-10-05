        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="quixnav">
            <div class="quixnav-scroll">
               @if (auth()->user()->level == "mahasiswa")
                <ul class="metismenu" id="menu">
                    <li><a href="/home">Request Surat</a></li>
                    <li><a href="/profile">Account</a></li>
                    <li><a href="{{ route('logout') }}">Logout</a></li>
                </ul>
               @elseif (auth()->user()->level == "dosen")
                <ul class="metismenu" id="menu">
                    <li><a href="{{ route('dashboard') }}">Request Surat</a></li>
                    <li><a href="{{ route('profile_dosen') }}">Account</a></li>
                    <li><a href="{{ route('logout') }}">Logout</a></li>
                </ul>
                @elseif (auth()->user()->level == "tu")
                <ul class="metismenu" id="menu">
                    <li><a href="{{ route('base') }}">Request Surat Mahasiswa</a></li>
                    <li><a href="{{ route('base-dosen') }}">Request Surat Dosen</a></li>
                    <li><a href="{{ route('base-akun') }}">Account</a></li>
                    <li><a href="{{ route('logout') }}">Logout</a></li>
                </ul>
                @elseif (auth()->user()->level == "kaprogdi")
                <ul class="metismenu" id="menu">
                    <li><a href="{{ route('rumah') }}">Request Surat Mahasiswa</a></li>
                    <li><a href="{{ route('rumah-dosen') }}">Request Surat Dosen</a></li>
                    <li><a href="{{ route('profile-kaprogdi') }}">Account</a></li>
                    <li><a href="{{ route('logout') }}">Logout</a></li>
                </ul>
                @endif
            </div>


        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->