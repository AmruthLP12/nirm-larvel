@if (has_field($page, 'faqs_items'))
    @php
        $faqs_text = get_field($page, 'faqs_text');
        $faqs_items = collect(get_field($page, 'faqs_items'));
    @endphp
    @if (!empty($faqs_items))
    <section class="faq">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="value">Frequently Asked Questions <span class="cou">.</span></h2>
                    <hr>
                    @if (!empty($faqs_text) && $faqs_text != '[]')
                    <p>{{$faqs_text}}</p>
                    <hr>
                    @endif
                    
                </div>
                <div class="col-lg-12">
                    <div class="accordion accordion-shadow">
                        @foreach ($faqs_items as $item)
                        @php
                            $item = collect($item)->pluck('value','slug')->all();
                        @endphp
                        <div class="ac-item @if($loop->first) ac-active @endif">
                            <h5 class="ac-title">{{$item['question']}}</h5>
                            <div class="ac-content" >
                                {!! $item['answer'] !!}
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
@endif