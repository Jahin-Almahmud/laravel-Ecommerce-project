<div class="deznav">
    <div class="deznav-scroll">
        <ul class="metismenu" id="menu">
            <li><a href="{{route('admindashboard')}}" class="ai-icon" aria-expanded="false">
                <i class="flaticon-381-networking"></i>
                <span class="nav-text">Dashboard</span>
            </a>
           </li>

           <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
            <i class="flaticon-381-settings-2"></i>
            <span class="nav-text">Profile</span>
            </a>
            <ul aria-expanded="false">
                <li><a href="{{route('adminprofile')}}">Profile Photo</a></li>
                <li><a href="{{route('adminpassword')}}">Password</a></li>
            </ul>
            </li>
            <li><a href="{{route('admincategory.index')}}" class="ai-icon" aria-expanded="false">
                <i class="flaticon-381-television"></i>
                <span class="nav-text">Category</span>
            </a>
           </li>
            <li><a href="{{route('adminproduct.index')}}" class="ai-icon" aria-expanded="false">
                <i class="flaticon-381-layer-1"></i>
                <span class="nav-text">Products</span>
            </a>
           </li>
            <li><a href="{{route('admincoupon.index')}}" class="ai-icon" aria-expanded="false">
                <i class="flaticon-381-internet"></i>
                <span class="nav-text">coupons</span>
            </a>
           </li>
            <li><a href="{{route('adminsubscriber')}}" class="ai-icon" aria-expanded="false">
                <i class="flaticon-381-networking"></i>
                <span class="nav-text">Subscribers</span>
            </a>
           </li>
           <hr>
            <li><a href="{{route('frontend')}}" class="ai-icon" aria-expanded="false">
                <i class="flaticon-381-home"></i>
                <span class="nav-text">Frontend</span>
            </a>
           </li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-settings-2"></i>
                    <span class="nav-text">Profile</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="index.html">Profile Photo change</a></li>
                    <li><a href="index.html">Password change</a></li>
                </ul>
            </li>


        </ul>


    </div>
</div>
