<div class="page">
    <div class="pagination justify-content-center">
        <a href="{{route('tutor.1')}}">&laquo;</a>
        <a class="{{Route::current()->getName() == 'tutor.1'?'active':''}}" href="{{route('tutor.1')}}">1</a>
        <a class="{{Route::current()->getName() == 'tutor.2'?'active':''}}" href="{{route('tutor.2')}}">2</a>
        <a class="{{Route::current()->getName() == 'tutor.3'?'active':''}}" href="{{route('tutor.3')}}">3</a>
        <a class="{{Route::current()->getName() == 'tutor.4'?'active':''}}"href="{{route('tutor.4')}}">4</a>
        <a href="{{route('tutor.4')}}">&raquo;</a>
    </div>
</div>
