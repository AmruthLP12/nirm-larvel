@php
    $html_menu = null;
@endphp
<section id="page-content" class="services-leg">
    <div class="container">
        <div class="row m-b-20">
            <div class="col-lg-12">
                <h1 class="cta-2614">{{$data->name ?? 'Resources'}} from Obii Kriationz Web LLP</h1>
                <br>
            </div>
            <div class="@if(!empty($html_menu)) col-lg-9 col-md-9 @else col-lg-12 col-md-12 @endif">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Sl No</th>
                            <th>Resource Title</th>
                            <th width="35%">Resource Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($resources as $key => $item)
                        <tr>
                            <td>{{showSTT($resources, $key)}}</td>
                            <td>{{$item->name}}</td>
                            <td>{!! $item->description !!}</td>
                            <td>
                                [form 
                                    id="{{$item->form_id}}" 
                                    type="modal" 
                                    text_button="Send Now"
                                    text_button_modal="Download Now"
                                    title="Download Now" 
                                    class_button="btn btn-default" 
                                    callback="downloadFile"
                                    callback_data="{{RvMedia::url($item->document)}}"
                                    referenceable_id="{{$item->id}}"
                                    referenceable_type="{{get_class($item)}}"
                                    class_form="text-light"][/form]
                                [form 
                                    id="{{$item->form_id}}" 
                                    type="modal" 
                                    text_button="Send Now"
                                    text_button_modal="Read Online"
                                    title="Read Online" 
                                    class_button="btn btn-success" 
                                    callback="downloadFile"
                                    callback_data="{{RvMedia::url($item->document)}}"
                                    referenceable_id="{{$item->id}}"
                                    referenceable_type="{{get_class($item)}}"
                                    class_form="text-light"][/form]
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4">No results...</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $resources->links() }}
            </div>
            @if (!empty($html_menu))
            <div class="col-md-3 col-lg-3">
                {!! $html_menu !!}
            </div>
            @endif
        </div>
        <!-- row end -->
    </div>
</section>
@include('theme.'.Theme::getThemeName().'::views.custom-fields.faqs', ['page' => $data])
<script>
    function downloadFile(file){
        if (file) {
            window.open(file, '_blank');
            setTimeout(() => {
                window.location.reload();
            }, 3000);
        }else{
            alert('File not found...');
        }
    }
</script>