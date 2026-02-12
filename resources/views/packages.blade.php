@extends('layouts.master')
@section('main-content')
<?php use App\User; ?>
<style>
    .ss-banner {
        padding: 160px 0px 200px !important;
        border-bottom: 1px solid #f2f2f2;
        color: rgb(255, 255, 255) !important;
        background: linear-gradient(to right, rgb(137, 33, 107), rgb(218, 68, 83)) !important;
        overflow: hidden;
    }
    .ss-banner::before, .ss-banner::after {
        content: "";
        position: absolute;
        border-radius: 50%;
        transition: all 0.5s ease;
        animation: zoomout 5s infinite linear both;
    }
    .ss-banner::before {
        left: -120px;
        top: -75px;
        width: 350px;
        height: 350px;
        background: rgb(158, 42, 101);
    }
     .ss-banner::after {
        right: -120px;
        bottom: -75px;
        width: 350px;
        height: 350px;
        background: rgb(218, 68, 83);
    }
    .ss-banner span.pri {
        margin: 0px auto;
        text-transform: uppercase;
        font-weight: 400;
        letter-spacing: 1px;
        color: #fff;
    }
    .ss-banner .heading{
        font-family:"Playfair Display", serif !important;
        color:white !important;
        margin-bottom:10px !important;
    }
    .ss-banner p {
        width: 100%;
        font-weight: 300;
        font-size: 16px;
        color: #f3f3f3;
    }
    .ss-banner span.nocre {
        margin: 0px auto;
        background: rgb(219, 33, 76);
        font-size: 12px;
        font-weight: 500;
        padding: 5px 10px;
        border-radius: 25px;
        color: #fff;
        width: auto;
    }
    .ss-container .feature--boxed-border.active:after{
        display:none;
    }
    .navbar-light .navbar-nav .nav-link{
        color:white !important;
    }
    .ss-container{
        margin-top:-125px;
    }
    .ss-package_bg {
        color: rgb(0, 0, 0);
        background: rgb(255, 255, 255);
        padding: 25px 30px;
        float: left;
        width: 100%;
        border: 2px solid rgb(253 37 109);
        border-radius: 35px;
        box-shadow: rgba(51, 51, 51, 0.05) 0px 1px 12px 0px;
        text-align: center;
    }
    .col-black{
        color:black !important;
    }
    .package_items {
        color: #818a91 !important;
    }
    .ss-container .c-base-1 {
        color: #E91E63 !important;
    }
    .ss-container .feature--bg-2 *:not(.btn):not(.alert):not(.form-control):not(.heading):not(a), .feature-inverse *:not(.btn):not(.alert):not(.form-control):not(.heading):not(a) {
        color: unset !important;
    }
    .bank-details .para{
        position: relative; 
    }
     .copy-text{

    position: absolute;
    right: 4px;
    top: -20px;
    font-size: 10px;
    background: #e91628;
    color: wheat;
    padding: 0 4px;
    border-radius: 7px;

    }
    .ss-package_bg.ss-online {
    min-height: 427px;
    margin-bottom: 20px;
}


    .special-image { position: absolute; width: 66px; height: auto; top: -20px; right: -20px; }

    /* Separate sections: Online vs Admin packages */
    .package-section-online {
        margin-bottom: 3rem;
        padding-bottom: 2.5rem;
        /* border-bottom: 2px solid rgba(233, 30, 99, 0.2); */
    }
    .package-section-admin {
        padding-top: 0.5rem;
    }
    .package-section-title {
        margin-bottom: 0.5rem;
    }
    .package-section-desc {
        font-size: 15px;
        color: #6c757d;
        max-width: 640px;
        margin-left: auto;
        margin-right: auto;
        margin-bottom: 1.5rem;
    }
    .ss-package_bg.ss-online {
        border-color: rgb(33, 150, 243);
        background: linear-gradient(to bottom, #fff 0%, #f8fbff 100%);
    }
    .ss-package_bg.ss-admin {
        border-color: rgb(253, 37, 109);
        background: linear-gradient(to bottom, #fff 0%, #fff8fb 100%);
    }

    .package-active-badge {
        display: inline-block;
        background: #2196F3;
        color: #fff;
        font-size: 12px;
        font-weight: 600;
        padding: 4px 10px;
        border-radius: 20px;
        margin-bottom: 6px;
    }
    .package-expiry-text {
        font-size: 13px;
        color: #2e7d32;
        font-weight: 500;
        margin-bottom: 8px;
    }

    /* Package tabs */
    .package-tabs {
        display: flex;
        justify-content: center;
        gap: 0;
        margin-bottom: 2rem;
        /* border-bottom: 2px solid #e0e0e0; */
        flex-wrap: wrap;
    }
    .package-tabs .tab-btn {
        padding: 12px 24px;
        font-size: 16px;
        font-weight: 600;
        color: #666;
        background: transparent;
        border: none;
        border: 3px solid #E91E63;
        margin-bottom: -2px;
        outline: none;
        cursor: pointer;
        transition: color 0.2s, border-color 0.2s;

    }

    
     
    .package-tabs .tab-btn.active,
    .package-tabs .tab-btn:hover {
        color: #ffffff;
        border: 3px solid #E91E63;
        background: #E91E63;
    }
    .package-tab-panel {
        display: none;
    }
    .package-tab-panel.active {
        display: block;
    }



    .ss-package_bg 
        { 
            display: flex; 
            justify-content: center;
        }

        .icon-block--style-1-v5 {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}


    @keyframes zoomout {
        0% {
            transform: scale(1);
        }
    
        50% {
            transform: scale(2);
            opacity: 0.7;
        }
    
        100% {
            transform: scale(1);
        }
    }
    @media screen and (min-width: 767px) {
        .col-sm-6 {
            flex: 0 0 33% !important;
            max-width: 33% !important;
        }
        .ss-1, .ss-2, .ss-3  {
            margin-top: -70px;
        }

        .ss-2 .block-content {
            margin-top: 75px;
        }
    }
    @media (max-width: 767px) {
        .package-tabs .tab-btn {
            padding: 12px 24px;
            font-size: 13px;
            width: 100%;
        }
    }





     
</style>


<section class="page-title page-title--style-1 ss-banner">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 text-center">
                <span class="pri">Pricing</span>
                <h1 class="heading heading-1 strong-700 mb-0">Get Started <br>Pick your Plan Now</h1>
                <p>Your Journey To Love Starts With The Perfect Package.</p>
                <span class="nocre">No credit card required</span>
            </div>
        </div>
    </div>
</section>
@php
    $standardPackages = $standardPackages ?? collect();
    $premiumPackages = $premiumPackages ?? collect();
    $userOnlinePackageDataid = $userOnlinePackageDataid ?? null;
    $userOnlineExpiresAtFormatted = $userOnlineExpiresAtFormatted ?? null;
    $userHasActiveOnlinePackage = $userHasActiveOnlinePackage ?? false;
    if ($standardPackages->isEmpty() && $premiumPackages->isEmpty()) {
        $standardPackages = collect($packages ?? []);
    }
@endphp
<section class="slice sct-color-1 pricing-plans pricing-plans--style-1 has-bg-cover bg-size-cover" style=" background-position: bottom bottom;">
    <div class="container ss-container mt-5">
        <span class="clearfix"></span>

        <div class="package-tabs" role="tablist">
            <button type="button" class="tab-btn active" data-tab="online" role="tab" aria-selected="true">Online Packages</button>
            <button type="button" class="tab-btn" data-tab="premium" role="tab" aria-selected="false">Premium / Admin-Assigned Packages</button>
        </div>

        <div id="tab-online" class="package-tab-panel active" role="tabpanel">
        <div class="package-section-online">
        <div class="row justify-content-center">
            <div class="col-12 text-center mb-3">
                <h2 class="heading heading-3 strong-600 col-black package-section-title">Online Packages</h2>
                <p class="package-section-desc">Pay online and get search access for a set duration. Choose how long you want to search Soul Mates (weekly, 1 month, 3 months, or 6 months).</p>
            </div>
        </div>
        @if(!$standardPackages->isEmpty())
        <div class="row justify-content-center">
            @foreach ($standardPackages as $package)
            @if($package->dataid!="99")
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 ss-{{$loop->iteration}} ss mt-2">
                <div class="feature feature--boxed-border feature--bg-2 active ss-package_bg ss-online height">
                    <div class="icon-block--style-1-v5 text-center">
                        <div class="block-icon c-gray-dark">
                            <li style="list-style-type: none;">
                                @php
                                    $imgPath = '/images/package_'.$package->dataid.'.png';
                                    if (!file_exists(public_path($imgPath))) $imgPath = '/images/package_10.png';
                                    $meta = method_exists($package, 'meta') ? $package->meta() : [];
                                @endphp
                                <img src="{{ $imgPath }}" class="img-sm" height="100">
                            </li>
                        </div>
                        {{--
                            NOTE:
                            Do NOT use HTML comments to "disable" Blade expressions.
                            Blade still evaluates {{ ... }} inside <!-- ... --> which can crash the page.

                            Old offline package markup removed from here.
                        --}}
                        <div class="block-content mt-3">
                            @if($userHasActiveOnlinePackage && $userOnlinePackageDataid === $package->dataid)
                            <div class="package-active-badge">Current plan</div>
                            <div class="package-expiry-text">Expires: {{ $userOnlineExpiresAtFormatted }}</div>
                            @endif
                            <h3 class="col-black heading heading-5 strong-500 mb-2"><strong>{{ $package->name }}</strong></h3>
                            @if(!empty($meta) && isset($meta['price']))
                                <div class="price-tag col-black" style="font-size: 20px;">
                                    {{ $meta['currency'] ?? 'USD' }} {{ number_format((float)$meta['price'], 2) }}
                                    <span class="c-gray-light" style="font-size: 14px;">/ {{ $meta['duration_label'] ?? '' }}</span>
                                </div>
                            @endif
                        </div>

                        <div class="py-2 text-center mb-2">
                                <a href="{{ url('package-details/'.$package->id) }}" class="btn btn-styled btn-sm btn-base-1 btn-outline btn-circle">
    View Package Details
</a>
                                @auth
                                    @if($userHasActiveOnlinePackage)
                                        <p class="package-expiry-text mt-2 mb-0">Subscribe again after {{ $userOnlineExpiresAtFormatted }}</p>
                                    @else
                                        <a href="{{ route('packages.checkout', ['id' => $package->id]) }}" class="btn btn-styled btn-sm btn-base-1 btn-circle mt-2">
                                            Buy Now
                                        </a>
                                    @endif
                                @else
                                    <a href="{{ url('login') }}" class="btn btn-styled btn-sm btn-base-1 btn-circle mt-2">
                                        Login to Buy
                                    </a>
                                @endauth

                            </div>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
        @else
        <p class="text-center text-muted py-4">No online packages available at the moment.</p>
        @endif
        </div>
        </div>
        </div>

        <div id="tab-premium" class="package-tab-panel" role="tabpanel">
        <div class="package-section-admin">
        <div class="row justify-content-center">
            <div class="col-12 text-center mb-3">
                <h2 class="heading heading-3 strong-600 col-black package-section-title">Premium / Admin-Assigned Packages</h2>
                <p class="package-section-desc">Assigned by admin (e.g. Platinum, Diamond, Royal, Sovereign Matchmaking). These define which Soul Mate categories you can search. Contact admin to get a package assigned.</p>
            </div>
        </div>
        @if(!$premiumPackages->isEmpty())
        <div class="container ss-container mt-2 ">
        <div class="row justify-content-center">
            @foreach ($premiumPackages as $package)
            @if($package->dataid!="99")
            @php
                $imgPath = '/images/package_'.$package->dataid.'.png';
                if (!file_exists(public_path($imgPath))) $imgPath = '/images/package_10.png';
            @endphp
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 ss-{{$loop->iteration}} ss mt-2">
                <div class="feature feature--boxed-border feature--bg-2 active ss-package_bg ss-admin  height">
                    <div class="icon-block--style-1-v5 text-center">
                        <div class="block-icon c-gray-dark">
                            <li style="list-style-type: none;">
                                <img src="{{ $imgPath }}" class="img-sm" height="100">
                            </li>
                        </div>
                        <div class="block-content mt-3">
                            <h3 class="col-black heading heading-5 strong-500 mb-2"><strong>{{ $package->name }}</strong></h3>
                        </div>
                        <div class="py-2 text-center mb-2">
                            <a href="{{ url('package-details/'.$package->id) }}" class="btn btn-styled btn-sm btn-base-1 btn-outline btn-circle">
                                View Package Details
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
        @else
        <p class="text-center text-muted py-4">No premium packages available at the moment.</p>
        @endif
        </div>
        </div>
        </div>
        </div>
    </div>
</section>

<script>
(function() {
    var tabBtns = document.querySelectorAll('.package-tabs .tab-btn');
    var panels = document.querySelectorAll('.package-tab-panel');
    tabBtns.forEach(function(btn) {
        btn.addEventListener('click', function() {
            var tab = this.getAttribute('data-tab');
            tabBtns.forEach(function(b) { b.classList.remove('active'); b.setAttribute('aria-selected', 'false'); });
            panels.forEach(function(p) { p.classList.remove('active'); });
            this.classList.add('active');
            this.setAttribute('aria-selected', 'true');
            var panel = document.getElementById('tab-' + tab);
            if (panel) panel.classList.add('active');
        });
    });
})();
</script>
   
     <div class="home-tit" style="background: black; margin-bottom:0;">
                        <p></p>
                        <h2><span>Our Services</span></h2>

                    </div>
    
<div class="match-buttons">
    
  <a href="#" class="match-btn digital-match" onclick="openPopupDetail()">Digital Match (Online Services)</a>
  <a href="#" class="match-btn personal-match" onclick="openPopupOffline()">Personal Match (Offline Service)</a>
</div>

<!-- Popup Modal -->
<div id="popup-modal-detail" class="popup-overlay">
<span class="close-btn" onclick="closePopupDetail()">&times;</span>
  <div class="popup-content">
    <h2>Digital Match (Online Services)</h2>
    <p>With our online service, clients create their own profiles and choose a plan according to their preferences. Based on the selected plan, they will see potential matches. They can express interest in a match, and if the other party accepts, both will be able to connect.</p>
    
    <p><strong>Special Offer:</strong> We are currently offering a <strong>50% discount</strong> on our website!</p>

    <p>For the best results, we highly recommend uploading a profile picture, as it increases the chances of receiving better responses.</p>

    
    
    <a href="https://urgentrishta.co/packages" class="popup-btn">I am Interested</a>
  </div>
</div>

<!-- Personal Match Popup -->
<div id="popup-modal-offline" class="popup-overlay">
  <div class="popup-content">
    <span class="close-btn" onclick="closePopupOffline()">&times;</span>
    <h2>Personal Match (Offline Service)</h2>
    <p>In our offline service, we provide four exclusive matchmaking services based on the client’s selected plan. Unlike online services, no discounts are available for this premium matchmaking experience.</p>

    <h3>1. Exclusive Access</h3>
    <p>Clients receive a unique login with a username and password to a private database where they can view detailed profiles (excluding photos). If they find a suitable match, they provide us with a code, and we will share the picture separately.</p>

    <h3>2. Personalized Weekly Matches</h3>
    <p>Our expert team curates and sends weekly match suggestions tailored to the client’s preferences.</p>

    <h3>3. Broadcast List</h3>
    <p>Clients are added to our exclusive broadcast list, where they receive new proposals daily.</p>

    <h3>4. Video Consultation</h3>
    <p>We arrange video sessions to present multiple matchmaking options, ensuring a smooth and transparent process.</p>

    <h2>Why Choose Us?</h2>
    <p>We never disappoint our clients! Unlike other services that show only a couple of proposals and disappear, we stay in touch with our clients and work continuously to find the perfect match based on their expectations.</p>

    <p><strong>This level of commitment and service is unmatched—you won’t find it anywhere else!</strong> So, get ready to enjoy a stress-free and professional matchmaking experience with us.</p>

    <a href="http://urgentrishta.wedlock204.com" class="popup-btn">I am Interested</a>
  </div>
</div>
<style>
.match-buttons {
  display: flex;
  justify-content: center;
  gap: 20px;
  padding-top: 20px;
  background: black;
}

a.match-btn.personal-match{
  background-color: transparent;
  color: #E91E63;
  border:1px solid #E91E63;
  padding: 12px 24px;
  text-decoration: none;
  font-size: 18px;
  border-radius: 6px;
  transition: 0.3s;
}
a.match-btn.personal-match:hover{
    background-color:  #E91E63;
  color: white;
  border:1px solid #E91E63;
}
a.match-btn.digital-match{
  background-color: #E91E63;
  color: #fff;
  padding: 12px 24px;
  text-decoration: none;
  font-size: 18px;
  border-radius: 6px;
  transition: 0.3s;
}
a.match-btn.digital-match:hover {
  background-color: transparent;
  color: #E91E63;
  border:1px solid #E91E63;
}

@media (max-width: 768px) {
  .match-buttons {
    flex-direction: column;
    align-items: center;
  }

  .match-btn {
    width: 80%;
    text-align: center;
  }
}

.popup-overlay {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.7);
  justify-content: center;
  align-items: center;
}

div#popup-modal-detail .popup-content, #popup-modal-offline .popup-content{
  background: #fff;
  padding: 20px;
  width: 80%;
  max-height:85vh;
  max-width: 600px;
  height: auto; 
  overflow-y: auto;
  border-radius: 8px;
  text-align: left;
  display: flex;
  flex-direction: column;
}
div#popup-modal-detail .popup-content h2, div#popup-modal-detail .popup-content h3, #popup-modal-offline .popup-content h2, #popup-modal-offline .popup-content h3{
    font-size: 20px;
}

div#popup-modal-detail .close-btn {
  position: absolute;
  top: 10px;
  right: 20px;
  font-size: 24px;
  cursor: pointer;
}

div#popup-modal-detail .popup-btn, #popup-modal-offline .popup-btn{
  display: inline-block;
  background-color: #D10000;
  color: #fff;
  padding: 10px 20px;
  margin-top: 15px;
  text-decoration: none;
  font-size: 16px;
  border-radius: 5px;
  transition: 0.3s;
  text-align: center;
}

div#popup-modal-detail .popup-btn:hover, #popup-modal-offline .popup-btn:hover {
  background-color: #E91E63;
}
.no-scroll {
  overflow: hidden;
  height: 100vh;
}
</style>

<script>
function openPopupDetail() {
  document.getElementById("popup-modal-detail").style.display = "flex";
  document.body.classList.add("no-scroll");
}

function closePopupDetail() {
  document.getElementById("popup-modal-detail").style.display = "none";
  document.body.classList.remove("no-scroll");
}

function openPopupOffline() {
  document.getElementById("popup-modal-offline").style.display = "flex";
  document.body.classList.add("no-scroll");
}

function closePopupOffline() {
  document.getElementById("popup-modal-offline").style.display = "none";
  document.body.classList.remove("no-scroll");
}
</script>

@auth
    @if(empty(User::retrieveUserObject()->online_package))
        <script type="text/javascript">
            $(document).ready(function() {
                swalAlert("info", "Select a Package", "Review packages available and contact Usman at 0304-0227000 for package activation.", null);
            });
        </script>
    @endif
@endauth

@endsection
