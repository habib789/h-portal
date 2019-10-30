<div class="col-12 col-md-3 mt-5">
    <div class="text-left">
        <div class="section-title">
            <p class="text-capitalize head"><span class="head1 text-capitalize">Departments</span></p>
        </div>
    </div>
    <div class="card-body">
        @foreach($departments as $department)
            <a class="text-capitalize text-decoration-none" href="{{ route('deptDoctor.show', $department->slug) }}">
                <div class="dept p-2">
                    {{ $department->name }}
                </div>
            </a>
        @endforeach
    </div>
</div>
