@push('after-styles')
@endpush
@extends('layouts.app')
@section('title', 'Faq')
@section('content')

   <div class="section-heading-page" >
      <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="text-center">
                    <h1 class="heading-page text-center-xs">FAQ</h1>
                </div>
              </div>
		  
        </div>
      </div>
    </div>

    <div class="container">
	    <section class="accordion-wrapper" data-accordion>
            @foreach($faq as $faq)
            <details>
            <summary>
                    {{$faq->question}}
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
            </summary>
            <div class="details-info">
                <p>{!!$faq->answer!!}</p>
            </div>
            </details>
            @endforeach
        </section>
    </div>



  <div class="foot-top">
    <div class="container">
        <div class="row justify-content-center align-items-center" >
            
                @foreach($section8 as $section8)
                <div class="col-md-3 text-center">
                    <img src="{{asset('uploads/images')}}/{{$section8->section_image}}">
                    <p class="event">{{$section8->section_name}}</p>
                </div>
                @endforeach
        </div>
    </div>
</div>


@push('after-scripts')
<script>

	/* alternative hassclass if/else */
	/* 1 */
 /* empty */
		/* 2 */
		$(".sidebar-menu-open").click(function(e){
			$(".sidebar-menu-overlay").addClass("show-menu");
			e.preventDefault();
		});
	$(".sidebar-menu-close").click(function(e){
			$(".sidebar-menu-overlay").removeClass("show-menu");
			e.preventDefault();
		});
		</script>
		<script>
		    const accordionItems = document.querySelectorAll("[data-accordion] > details");

const siblings = (el) => {
  if (el.parentNode === null) return [];
  return Array.prototype.filter.call(el.parentNode.children, function (child) {
    return child !== el;
  });
};

accordionItems.forEach((el) => {
  el.addEventListener("click", () => {
    const others = siblings(el);
    others.forEach((sibling) => {
      sibling.removeAttribute("open");
    });
  });
});

</script>
@endpush
@endsection
