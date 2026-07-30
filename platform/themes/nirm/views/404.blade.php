@php
    SeoHelper::setTitle(__('404 - Not found'));
    Theme::fire('beforeRenderTheme', app(\Obii\Theme\Contracts\Theme::class));
@endphp

{!! Theme::partial('header') !!}
    <main>
        <section class="p-5">
            <div class="container">
                <div class="text-center">
                    <div class="row">
                        <div class="col-lg-6">
                            <h1>404</h1>
                        </div>
                        <div class="col-lg-6">
                            <div class="text-left">
                                <h1 class="text-medium">Opps, This Page Could Not Be Found!</h1>
                                <p>We have logged the issue and we will fix it shortly. Thanks for the trust, luke!</p>
                                <div class="seperator m-t-20 m-b-20"></div>
                                
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </section>
    </main>
</div>
{!! Theme::partial('footer') !!}


