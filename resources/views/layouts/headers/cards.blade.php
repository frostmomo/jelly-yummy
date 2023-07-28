<div></div>
<div class="header bg-yellow pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">{{ $pageTitle }}</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            @foreach ($breadcrumbs as $breadcrumb)
                                <li class="breadcrumb-item"><a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['label'] }}</a></li>
                            @endforeach
                            <li class="breadcrumb-item active" aria-current="page">{{ $activePage }}</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-lg-6 col-5 text-right">
                    <!-- Add your buttons here -->
                    <!-- Example: <a href="#" class="btn btn-sm btn-neutral">New</a> -->
                </div>
            </div>
        </div>
    </div>
</div>