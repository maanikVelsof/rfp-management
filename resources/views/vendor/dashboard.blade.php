<x-app-layout>
    <x-breadcrumb :title="'Dashboard'" :breadcrumbs=[] />
    
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div>Welcome to Vendor Dashboard.</div>
                    <a href="{{ route('profile.edit')}}">Profile Edit </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>