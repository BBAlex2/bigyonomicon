@extends('layouts.app')

@section('content')
<div class="container text-center bg-dark">
    <p class="fs-1 clr-light font-large">Kapcsolat</p>
    <div class='row g-4 py-4'>
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="bi bi-person-circle fs-1 clr-yellow mb-3"></i>
                    <h3 class="card-title font-large clr-yellow">Barta Márk</h3>
                    <p class="card-text clr-light">Backend fejlesztő</p>
                    <p class="card-text clr-light"><i class="bi bi-envelope-fill me-2"></i>bartamark@bigyonomicon.hu</p>
                    <p class="card-text clr-light"><i class="bi bi-telephone-fill me-2"></i>+36 20 123 4567</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="bi bi-person-circle fs-1 clr-yellow mb-3"></i>
                    <h3 class="card-title font-large clr-yellow">Simon Soma Benedek</h3>
                    <p class="card-text clr-light">Offline funkció fejlesztő</p>
                    <p class="card-text clr-light"><i class="bi bi-envelope-fill me-2"></i>ssomabenedek@bigyonomicon.hu</p>
                    <p class="card-text clr-light"><i class="bi bi-telephone-fill me-2"></i>+36 30 987 6543</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="bi bi-person-circle fs-1 clr-yellow mb-3"></i>
                    <h3 class="card-title font-large clr-yellow">Badari-Békés Alex</h3>
                    <p class="card-text clr-light">Frontend fejlesztő</p>
                    <p class="card-text clr-light"><i class="bi bi-envelope-fill me-2"></i>badaribekesalex@bigyonomicon.hu</p>
                    <p class="card-text clr-light"><i class="bi bi-telephone-fill me-2"></i>+36 70 456 7890</p>
                </div>
            </div>
        </div>
    </div>
    
    <div id="contactMap" class="w-100 mt-4" style="height: 400px;"></div>
</div>
@endsection

