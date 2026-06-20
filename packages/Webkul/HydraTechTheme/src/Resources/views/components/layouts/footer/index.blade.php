{!! view_render_event('bagisto.shop.layout.footer.before') !!}

<!--
    The category repository is injected directly here because there is no way
    to retrieve it from the view composer, as this is an anonymous component.
-->
@inject('themeCustomizationRepository', 'Webkul\Theme\Repositories\ThemeCustomizationRepository')

<!--
    This code needs to be refactored to reduce the amount of PHP in the Blade
    template as much as possible.
-->
@php
    $channel = core()->getCurrentChannel();

    $customization = $themeCustomizationRepository->findOneWhere([
        'type'       => 'footer_links',
        'status'     => 1,
        'theme_code' => $channel->theme,
        'channel_id' => $channel->id,
    ]);
@endphp

<footer class="mt-9 bg-lightOrange max-sm:mt-10">
    <div class="container mx-auto grid grid-cols-3 gap-8 p-[60px] max-1060:grid-cols-2 max-lg:px-8 max-md:grid-cols-1 max-md:p-8 max-md:px-4 max-sm:px-4 max-sm:py-5">
        <!-- Column 1: Logo & Description -->
        <div class="grid gap-4 content-start">
            <a href="{{ route('shop.home.index') }}">
                <img
                    src="{{ core()->getCurrentChannel()->logo_url ?? bagisto_asset('images/logo.svg') }}"
                    alt="Phill Technologies"
                    width="300"
                    height="auto"
                />
            </a>

            <p class="text-sm text-zinc-600 max-w-[260px]">
                Your trusted partner for innovative technology solutions. We deliver excellence in every project.
            </p>
        </div>

        <!-- Column 2: Quick Links -->
        <div class="grid gap-4 content-start max-1060:order-3">
            <p class="text-base font-semibold text-navyBlue font-dmserif">
                Quick Links
            </p>

            <div class="flex flex-wrap gap-12">
                @if ($customization?->options)
                    @foreach ($customization->options as $footerLinkSection)
                        <ul class="grid gap-3 text-sm">
                            @php
                                usort($footerLinkSection, function ($a, $b) {
                                    return $a['sort_order'] - $b['sort_order'];
                                });
                            @endphp

                            @foreach ($footerLinkSection as $link)
                                <li>
                                    <a
                                        href="{{ $link['url'] }}"
                                        class="text-zinc-600 hover:text-navyBlue transition-colors"
                                    >
                                        {{ $link['title'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endforeach
                @endif
            </div>
        </div>

        <!-- Column 3: Contact Info -->
        <div class="grid gap-4 content-start max-1060:order-2">
            <p class="text-base font-semibold text-navyBlue font-dmserif">
                Contact Us
            </p>

            <div class="grid gap-4 text-sm text-zinc-600">
                <div class="flex items-center gap-3">
                    <span class="icon-location text-navyBlue text-lg"></span>
                    <span>123 Tech Avenue, Nairobi, Kenya</span>
                </div>

                <div class="flex items-center gap-3">
                    <span class="icon-email text-navyBlue text-lg"></span>
                    <a href="mailto:info@philltechnologies.com" class="hover:text-navyBlue transition-colors">info@philltechnologies.com</a>
                </div>

                <div class="flex items-center gap-3">
                    <span class="icon-support text-navyBlue text-lg"></span>
                    <a href="tel:+254700000000" class="hover:text-navyBlue transition-colors">+254 700 000 000</a>
                </div>
            </div>
        </div>
    </div>

    <div class="flex justify-between bg-[#F1EADF] px-[60px] py-3.5 max-md:flex-col max-md:gap-2 max-md:text-center max-sm:px-5">
        {!! view_render_event('bagisto.shop.layout.footer.footer_text.before') !!}

        <p class="text-[13px] font-poppins font-normal text-zinc-500">
            Website by <a href="https://hydratech.co.ke" target="_blank" class="hover:underline hover:text-zinc-700">HydraTech</a>
        </p>

        <p class="text-[13px] font-poppins font-normal text-zinc-500">
            Phill Technologies &copy; {{ date('Y') }} | All Rights Reserved.
        </p>

        <p class="text-[13px] font-poppins font-normal text-zinc-500">
            <a class="text-zinc-500 hover:text-zinc-700" href="{{ url('/page/terms-conditions') }}">Terms &amp; Condition</a>
            <span class="text-zinc-400 px-1.5">|</span>
            <a class="text-zinc-500 hover:text-zinc-700" href="{{ url('/page/privacy-policy') }}">Privacy Policy</a>
        </p>

        {!! view_render_event('bagisto.shop.layout.footer.footer_text.after') !!}
    </div>
</footer>

{!! view_render_event('bagisto.shop.layout.footer.after') !!}
