@extends('partials.layouts.master2')

    @section('title', 'UI Accordions | Herozi - The Worlds Best Selling Bootstrap Admin & Dashboard Template by SRBThemes')
    @section('sub-title', 'Accordion' )
    @section('pagetitle', 'Home')
    @section('buttonTitle', 'Share')
    @section('modalTarget', 'shareModal')
  

    @section('content')

    <div class="row g-4">

        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0">Basic</h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">Use the <code>accordion</code> class to expand/collapse the accordion content.</p>

                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#demo_accordion_item_01" aria-expanded="true" aria-controls="demo_accordion_item_01">
                                    Accordion Item #1
                                </button>
                            </h2>
                            <div id="demo_accordion_item_01" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <strong class="text-body fw-medium">This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#demo_accordion_item_02" aria-expanded="false" aria-controls="demo_accordion_item_02">
                                    Accordion Item #2
                                </button>
                            </h2>
                            <div id="demo_accordion_item_02" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <strong class="text-body fw-medium">This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#demo_accordion_item_03" aria-expanded="false" aria-controls="demo_accordion_item_03">
                                    Accordion Item #3
                                </button>
                            </h2>
                            <div id="demo_accordion_item_03" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <strong class="text-body fw-medium">This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- end card-body -->
            </div>
            <!--end::card-->
        </div>

        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0">Flush</h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">Use <code>accordion-flush</code> class to remove the default background-color, some borders, and some rounded corners to render accordions edge-to-edge with their parent container.</p>

                    <div class="accordion accordion-flush" id="demo_accordian_main_02">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#demo_accordion_item_11" aria-expanded="true" aria-controls="demo_accordion_item_11">
                                    Accordion Item #1
                                </button>
                            </h2>
                            <div id="demo_accordion_item_11" class="accordion-collapse collapse show" data-bs-parent="#demo_accordian_main_02">
                                <div class="accordion-body">
                                    <strong class="text-body fw-medium">This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#demo_accordion_item_12" aria-expanded="false" aria-controls="demo_accordion_item_12">
                                    Accordion Item #2
                                </button>
                            </h2>
                            <div id="demo_accordion_item_12" class="accordion-collapse collapse" data-bs-parent="#demo_accordian_main_02">
                                <div class="accordion-body">
                                    <strong class="text-body fw-medium">This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#demo_accordion_item_13" aria-expanded="false" aria-controls="demo_accordion_item_13">
                                    Accordion Item #3
                                </button>
                            </h2>
                            <div id="demo_accordion_item_13" class="accordion-collapse collapse" data-bs-parent="#demo_accordian_main_02">
                                <div class="accordion-body">
                                    <strong class="text-body fw-medium">This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- end card-body -->
            </div>
            <!--end::card-->
        </div>

        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0">Accordions with Icons</h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">Use <code>accordion-icon</code> class to show custom icon at accordion.</p>

                    <div class="accordion accordion-icon" id="demo_accordian_main_03">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#demo_accordion_item_31" aria-expanded="true" aria-controls="demo_accordion_item_31">
                                    <i class="ri-code-line me-2"></i> Frontend Development
                                </button>
                            </h2>
                            <div id="demo_accordion_item_31" class="accordion-collapse collapse" data-bs-parent="#demo_accordian_main_03">
                                <div class="accordion-body">
                                    <strong class="text-body fw-medium">Frontend Development</strong> focuses on creating the visual aspects of a website or application that users interact with. This includes designing and implementing user interfaces (UI) using HTML, CSS, and JavaScript. For example, using Bootstrap to quickly style and layout responsive components can significantly streamline the development process.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#demo_accordion_item_32" aria-expanded="false" aria-controls="demo_accordion_item_32">
                                    <i class="ri-braces-line me-2"></i> Backend Development
                                </button>
                            </h2>
                            <div id="demo_accordion_item_32" class="accordion-collapse collapse" data-bs-parent="#demo_accordian_main_03">
                                <div class="accordion-body">
                                    <strong class="text-body fw-medium">Backend Development</strong> involves server-side programming that powers the functionalities behind the scenes of a website or application. This includes working with databases, server logic, and APIs. For instance, using frameworks like Node.js or Django helps in efficiently managing server-side operations and handling data interactions.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#demo_accordion_item_33" aria-expanded="false" aria-controls="demo_accordion_item_33">
                                    <i class="ri-paint-brush-line me-2"></i> Bootstrap Customizations
                                </button>
                            </h2>
                            <div id="demo_accordion_item_33" class="accordion-collapse collapse" data-bs-parent="#demo_accordian_main_03">
                                <div class="accordion-body">
                                    <strong class="text-body fw-medium">Bootstrap Customizations</strong> allow you to tailor the Bootstrap framework to better fit your project’s needs. This can involve overriding default Bootstrap variables using custom CSS, or utilizing the Bootstrap theme customizer. For example, you can adjust the color scheme and spacing of Bootstrap components to align with your branding guidelines and improve the overall aesthetics of your application.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card-body -->
            </div>
            <!--end::card-->
        </div>

        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0">Accordions without Icons</h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">Use the <code>.accordion-icon-none</code> class to create Bootstrap accordions <strong class="text-body fw-medium">without icons</strong>. This class hides any default icons, giving your accordion a cleaner look.</p>

                    <div class="accordion accordion-icon-none" id="demo_accordian_main_04">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#demo_accordion_item_41" aria-expanded="true" aria-controls="demo_accordion_item_41">
                                    <span class="accordion-icon me-2">
                                        <i class="ri-code-line"></i>
                                    </span>
                                    Frontend Development
                                </button>
                            </h2>
                            <div id="demo_accordion_item_41" class="accordion-collapse collapse" data-bs-parent="#demo_accordian_main_04">
                                <div class="accordion-body">
                                    <strong class="text-body fw-medium">Frontend Development</strong> focuses on creating the visual aspects of a website or application that users interact with. This includes designing and implementing user interfaces (UI) using HTML, CSS, and JavaScript. For example, using Bootstrap to quickly style and layout responsive components can significantly streamline the development process.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#demo_accordion_item_42" aria-expanded="false" aria-controls="demo_accordion_item_42">
                                    <i class="ri-braces-line me-2"></i> Backend Development
                                </button>
                            </h2>
                            <div id="demo_accordion_item_42" class="accordion-collapse collapse" data-bs-parent="#demo_accordian_main_04">
                                <div class="accordion-body">
                                    <strong class="text-body fw-medium">Backend Development</strong> involves server-side programming that powers the functionalities behind the scenes of a website or application. This includes working with databases, server logic, and APIs. For instance, using frameworks like Node.js or Django helps in efficiently managing server-side operations and handling data interactions.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#demo_accordion_item_43" aria-expanded="false" aria-controls="demo_accordion_item_43">
                                    <i class="ri-paint-brush-line me-2"></i> Bootstrap Customizations
                                </button>
                            </h2>
                            <div id="demo_accordion_item_43" class="accordion-collapse collapse" data-bs-parent="#demo_accordian_main_04">
                                <div class="accordion-body">
                                    <strong class="text-body fw-medium">Bootstrap Customizations</strong> allow you to tailor the Bootstrap framework to better fit your project’s needs. This can involve overriding default Bootstrap variables using custom CSS, or utilizing the Bootstrap theme customizer. For example, you can adjust the color scheme and spacing of Bootstrap components to align with your branding guidelines and improve the overall aesthetics of your application.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card-body -->
            </div>
            <!--end::card-->
        </div>

        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0">Accordions with Plus Icon</h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">Use the <code>.accordion-with-plus</code> class to add a <strong class="text-body fw-medium">plus icon</strong> to your Bootstrap accordion. Place the icon inside the <code>.accordion-header</code> to indicate expand/collapse functionality.</p>

                    <div class="accordion accordion-with-plus" id="demo_accordian_main_06">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#demo_accordion_item_61" aria-expanded="true" aria-controls="demo_accordion_item_61">
                                    <span class="accordion-icon me-2">
                                        <i class="ri-code-line"></i>
                                    </span>
                                    Frontend Development
                                </button>
                            </h2>
                            <div id="demo_accordion_item_61" class="accordion-collapse collapse" data-bs-parent="#demo_accordian_main_06">
                                <div class="accordion-body">
                                    <strong class="text-body fw-medium">Frontend Development</strong> focuses on creating the visual aspects of a website or application that users interact with. This includes designing and implementing user interfaces (UI) using HTML, CSS, and JavaScript. For example, using Bootstrap to quickly style and layout responsive components can significantly streamline the development process.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#demo_accordion_item_62" aria-expanded="false" aria-controls="demo_accordion_item_62">
                                    <i class="ri-braces-line me-2"></i> Backend Development
                                </button>
                            </h2>
                            <div id="demo_accordion_item_62" class="accordion-collapse collapse" data-bs-parent="#demo_accordian_main_06">
                                <div class="accordion-body">
                                    <strong class="text-body fw-medium">Backend Development</strong> involves server-side programming that powers the functionalities behind the scenes of a website or application. This includes working with databases, server logic, and APIs. For instance, using frameworks like Node.js or Django helps in efficiently managing server-side operations and handling data interactions.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#demo_accordion_item_63" aria-expanded="false" aria-controls="demo_accordion_item_63">
                                    <i class="ri-paint-brush-line me-2"></i> Bootstrap Customizations
                                </button>
                            </h2>
                            <div id="demo_accordion_item_63" class="accordion-collapse collapse" data-bs-parent="#demo_accordian_main_06">
                                <div class="accordion-body">
                                    <strong class="text-body fw-medium">Bootstrap Customizations</strong> allow you to tailor the Bootstrap framework to better fit your project’s needs. This can involve overriding default Bootstrap variables using custom CSS, or utilizing the Bootstrap theme customizer. For example, you can adjust the color scheme and spacing of Bootstrap components to align with your branding guidelines and improve the overall aesthetics of your application.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card-body -->
            </div>
            <!--end::card-->
        </div>

        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0">Accordions with Left Icon</h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">Use the <code>.accordion-with-left-icon</code> class to add an <strong class="text-body fw-medium">icon on the left</strong> of each accordion item. Place your icon in an <code>&lt;i&gt;</code> tag within the <code>.accordion-header</code>.</p>

                    <div class="accordion accordion-with-plus accordion-with-left-icon" id="demo_accordian_main_07">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#demo_accordion_item_71" aria-expanded="true" aria-controls="demo_accordion_item_71">
                                    Frontend Development
                                </button>
                            </h2>
                            <div id="demo_accordion_item_71" class="accordion-collapse collapse" data-bs-parent="#demo_accordian_main_07">
                                <div class="accordion-body">
                                    <strong class="text-body fw-medium">Frontend Development</strong> focuses on creating the visual aspects of a website or application that users interact with. This includes designing and implementing user interfaces (UI) using HTML, CSS, and JavaScript. For example, using Bootstrap to quickly style and layout responsive components can significantly streamline the development process.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#demo_accordion_item_72" aria-expanded="false" aria-controls="demo_accordion_item_72">
                                    Backend Development
                                </button>
                            </h2>
                            <div id="demo_accordion_item_72" class="accordion-collapse collapse" data-bs-parent="#demo_accordian_main_07">
                                <div class="accordion-body">
                                    <strong class="text-body fw-medium">Backend Development</strong> involves server-side programming that powers the functionalities behind the scenes of a website or application. This includes working with databases, server logic, and APIs. For instance, using frameworks like Node.js or Django helps in efficiently managing server-side operations and handling data interactions.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#demo_accordion_item_73" aria-expanded="false" aria-controls="demo_accordion_item_73">
                                    Bootstrap Customizations
                                </button>
                            </h2>
                            <div id="demo_accordion_item_73" class="accordion-collapse collapse" data-bs-parent="#demo_accordian_main_07">
                                <div class="accordion-body">
                                    <strong class="text-body fw-medium">Bootstrap Customizations</strong> allow you to tailor the Bootstrap framework to better fit your project’s needs. This can involve overriding default Bootstrap variables using custom CSS, or utilizing the Bootstrap theme customizer. For example, you can adjust the color scheme and spacing of Bootstrap components to align with your branding guidelines and improve the overall aesthetics of your application.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card-body -->
            </div>
            <!--end::card-->
        </div>

        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0">Accordions with theme color</h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">Customize your Bootstrap accordion header with <strong class="text-body fw-medium">theme colors</strong> by applying classes like <code>.accordion-primary</code> or <code>.text-white</code>.</p>

                    <div class="accordion accordion-primary accordion-border-box" id="demo_accordian_main_08">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#demo_accordion_item_81" aria-expanded="true" aria-controls="demo_accordion_item_81">
                                    Frontend Development
                                </button>
                            </h2>
                            <div id="demo_accordion_item_81" class="accordion-collapse collapse" data-bs-parent="#demo_accordian_main_08">
                                <div class="accordion-body">
                                    <strong class="text-body fw-medium">Frontend Development</strong> focuses on creating the visual aspects of a website or application that users interact with. This includes designing and implementing user interfaces (UI) using HTML, CSS, and JavaScript. For example, using Bootstrap to quickly style and layout responsive components can significantly streamline the development process.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#demo_accordion_item_82" aria-expanded="false" aria-controls="demo_accordion_item_82">
                                    Backend Development
                                </button>
                            </h2>
                            <div id="demo_accordion_item_82" class="accordion-collapse collapse" data-bs-parent="#demo_accordian_main_08">
                                <div class="accordion-body">
                                    <strong class="text-body fw-medium">Backend Development</strong> involves server-side programming that powers the functionalities behind the scenes of a website or application. This includes working with databases, server logic, and APIs. For instance, using frameworks like Node.js or Django helps in efficiently managing server-side operations and handling data interactions.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#demo_accordion_item_83" aria-expanded="false" aria-controls="demo_accordion_item_83">
                                    Bootstrap Customizations
                                </button>
                            </h2>
                            <div id="demo_accordion_item_83" class="accordion-collapse collapse" data-bs-parent="#demo_accordian_main_08">
                                <div class="accordion-body">
                                    <strong class="text-body fw-medium">Bootstrap Customizations</strong> allow you to tailor the Bootstrap framework to better fit your project’s needs. This can involve overriding default Bootstrap variables using custom CSS, or utilizing the Bootstrap theme customizer. For example, you can adjust the color scheme and spacing of Bootstrap components to align with your branding guidelines and improve the overall aesthetics of your application.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card-body -->
            </div>
            <!--end::card-->
        </div>

        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0">Accordions with subtitle</h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">Add <strong class="text-body fw-medium">subtitles</strong> to Bootstrap accordions by including a <code>&lt;h6&gt;</code> or <code>&lt;small&gt;</code> tag in the <code>.accordion-header</code>. This provides extra context for each section.</p>

                    <div class="accordion accordion-primary accordion-border-box" id="demo_accordian_main_09">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <div class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#demo_accordion_item_91" aria-expanded="true" aria-controls="demo_accordion_item_91">
                                    <div>
                                        <p class="mb-0">Frontend Development</p>
                                        <p class="fs-12 mb-0 mt-1">Press to expand</p>
                                    </div>
                                </div>
                            </h2>
                            <div id="demo_accordion_item_91" class="accordion-collapse collapse" data-bs-parent="#demo_accordian_main_09">
                                <div class="accordion-body">
                                    <strong class="text-body fw-medium">Frontend Development</strong> focuses on creating the visual aspects of a website or application that users interact with. This includes designing and implementing user interfaces (UI) using HTML, CSS, and JavaScript. For example, using Bootstrap to quickly style and layout responsive components can significantly streamline the development process.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <div class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#demo_accordion_item_92" aria-expanded="false" aria-controls="demo_accordion_item_92">
                                    <div>
                                        <p class="mb-0">Backend Development</p>
                                        <p class="fs-12 mb-0 mt-1">Press to expand</p>
                                    </div>
                                </div>
                            </h2>
                            <div id="demo_accordion_item_92" class="accordion-collapse collapse" data-bs-parent="#demo_accordian_main_09">
                                <div class="accordion-body">
                                    <strong class="text-body fw-medium">Backend Development</strong> involves server-side programming that powers the functionalities behind the scenes of a website or application. This includes working with databases, server logic, and APIs. For instance, using frameworks like Node.js or Django helps in efficiently managing server-side operations and handling data interactions.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <div class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#demo_accordion_item_93" aria-expanded="false" aria-controls="demo_accordion_item_93">
                                    <div>
                                        <p class="mb-0">Bootstrap Customizations</p>
                                        <p class="fs-12 mb-0 mt-1">Press to expand</p>
                                    </div>
                                </div>
                            </h2>
                            <div id="demo_accordion_item_93" class="accordion-collapse collapse" data-bs-parent="#demo_accordian_main_09">
                                <div class="accordion-body">
                                    <strong class="text-body fw-medium">Bootstrap Customizations</strong> allow you to tailor the Bootstrap framework to better fit your project’s needs. This can involve overriding default Bootstrap variables using custom CSS, or utilizing the Bootstrap theme customizer. For example, you can adjust the color scheme and spacing of Bootstrap components to align with your branding guidelines and improve the overall aesthetics of your application.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card-body -->
            </div>
            <!--end::card-->
        </div>

        <div class="col-12">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0">Accordion With Content</h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">You can create an <strong class="text-body fw-medium">accordion with images</strong> in Bootstrap by including <code>&lt;img&gt;</code> tags within the <code>.accordion-header</code> section. This lets you display images alongside text content, enhancing visual appeal and information delivery.</p>

                    <div class="accordion accordion-border-box" id="demo_accordian_main_10">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <div class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#demo_accordion_item_100" aria-expanded="true" aria-controls="demo_accordion_item_100">
                                    <div class="avatar-image avatar-lg me-3">
                                        <img class="img-fluid rounded-2" src="{{ asset('assets/images/avatar/avatar-1.jpg') }}" alt="avatar image">
                                    </div>
                                    <div>
                                        <p class="mb-0">Frontend Development</p>
                                        <p class="fs-12 mb-0 mt-1">Press to expand</p>
                                    </div>
                                </div>
                            </h2>
                            <div id="demo_accordion_item_100" class="accordion-collapse collapse" data-bs-parent="#demo_accordian_main_10">
                                <div class="accordion-body">
                                    <strong class="text-body fw-medium">Frontend Development</strong> focuses on creating the visual aspects of a website or application that users interact with. This includes designing and implementing user interfaces (UI) using HTML, CSS, and JavaScript. For example, using Bootstrap to quickly style and layout responsive components can significantly streamline the development process.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <div class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#demo_accordion_item_101" aria-expanded="false" aria-controls="demo_accordion_item_101">
                                    <div class="avatar-image avatar-lg me-3">
                                        <img class="img-fluid rounded-2" src="{{ asset('assets/images/avatar/avatar-2.jpg') }}" alt="avatar image">
                                    </div>
                                    <div>
                                        <p class="mb-0">Backend Development</p>
                                        <p class="fs-12 mb-0 mt-1">Press to expand</p>
                                    </div>
                                </div>
                            </h2>
                            <div id="demo_accordion_item_101" class="accordion-collapse collapse" data-bs-parent="#demo_accordian_main_10">
                                <div class="accordion-body">
                                    <strong class="text-body fw-medium">Backend Development</strong> involves server-side programming that powers the functionalities behind the scenes of a website or application. This includes working with databases, server logic, and APIs. For instance, using frameworks like Node.js or Django helps in efficiently managing server-side operations and handling data interactions.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <div class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#demo_accordion_item_103" aria-expanded="false" aria-controls="demo_accordion_item_103">
                                    <div class="avatar-image avatar-lg me-3">
                                        <img class="img-fluid rounded-2" src="{{ asset('assets/images/avatar/avatar-3.jpg') }}" alt="avatar image">
                                    </div>
                                    <div>
                                        <p class="mb-0">Bootstrap Customizations</p>
                                        <p class="fs-12 mb-0 mt-1">Press to expand</p>
                                    </div>
                                </div>
                            </h2>
                            <div id="demo_accordion_item_103" class="accordion-collapse collapse" data-bs-parent="#demo_accordian_main_10">
                                <div class="accordion-body">
                                    <strong class="text-body fw-medium">Bootstrap Customizations</strong> allow you to tailor the Bootstrap framework to better fit your project’s needs. This can involve overriding default Bootstrap variables using custom CSS, or utilizing the Bootstrap theme customizer. For example, you can adjust the color scheme and spacing of Bootstrap components to align with your branding guidelines and improve the overall aesthetics of your application.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card-body -->
            </div>
            <!--end::card-->
        </div>

        <div class="col-12">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0">Nesting Accordions</h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">With Bootstrap, you can create <strong class="text-body fw-medium">nested accordions</strong> to organize content hierarchically. To do this, simply place an <code>&lt;accordion&gt;</code> component inside another <code>&lt;accordion&gt;</code>. Make sure each nested accordion has a unique <code>ID</code> for proper functionality.</p>

                    <!-- Main Accordion Wrapper -->
                    <div class="accordion accordion-light" id="main_accordion">

                        <!-- Frontend Development Accordion -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#step_1" aria-expanded="true" aria-controls="step_1">
                                    <i class="ri-code-line me-2"></i> Frontend Development
                                </button>
                            </h2>
                            <div id="step_1" class="accordion-collapse collapse show" data-bs-parent="#main_accordion">
                                <div class="accordion-body">

                                    <!-- Nested Frontend Steps Accordion -->
                                    <div class="accordion" id="frontend_steps">

                                        <!-- Frontend Step 1 Accordion -->
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#frontend_step_1" aria-expanded="true" aria-controls="frontend_step_1">
                                                    <i class="ri-file-code-line me-2"></i> Step 1: Setting Up
                                                </button>
                                            </h2>
                                            <div id="frontend_step_1" class="accordion-collapse collapse show" data-bs-parent="#frontend_steps">
                                                <div class="accordion-body">
                                                    Set up your development environment by installing necessary tools and frameworks like Node.js, npm, and a code editor.

                                                    <!-- Additional Nested Level for Step 1 -->
                                                    <div class="accordion mt-3" id="frontend_setup_details">
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header">
                                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#frontend_setup_step_1" aria-expanded="false" aria-controls="frontend_setup_step_1">
                                                                    <i class="ri-terminal-box-line me-2"></i> Tools Setup
                                                                </button>
                                                            </h2>
                                                            <div id="frontend_setup_step_1" class="accordion-collapse collapse show" data-bs-parent="#frontend_setup_details">
                                                                <div class="accordion-body">
                                                                    Install tools such as Node.js, npm, and any code editor like VSCode.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End of Nested Level -->
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Frontend Step 1 Accordion -->

                                        <!-- Frontend Step 2 Accordion -->
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#frontend_step_2" aria-expanded="false" aria-controls="frontend_step_2">
                                                    <i class="ri-brush-line me-2"></i> Step 2: Designing UI
                                                </button>
                                            </h2>
                                            <div id="frontend_step_2" class="accordion-collapse collapse" data-bs-parent="#frontend_steps">
                                                <div class="accordion-body">
                                                    Design UI using tools like Figma or Adobe XD.

                                                    <!-- Additional Nested Level for Step 2 -->
                                                    <div class="accordion mt-3" id="frontend_design_details">
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header">
                                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#frontend_design_step_1" aria-expanded="false" aria-controls="frontend_design_step_1">
                                                                    <i class="ri-layout-line me-2"></i> Wireframes
                                                                </button>
                                                            </h2>
                                                            <div id="frontend_design_step_1" class="accordion-collapse collapse" data-bs-parent="#frontend_design_details">
                                                                <div class="accordion-body">
                                                                    Create wireframes to plan the application layout.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End of Nested Level -->
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Frontend Step 2 Accordion -->

                                        <!-- Frontend Step 3 Accordion -->
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#frontend_step_3" aria-expanded="false" aria-controls="frontend_step_3">
                                                    <i class="ri-terminal-line me-2"></i> Step 3: Coding and Testing
                                                </button>
                                            </h2>
                                            <div id="frontend_step_3" class="accordion-collapse collapse" data-bs-parent="#frontend_steps">
                                                <div class="accordion-body">
                                                    Code frontend components and perform regular testing.

                                                    <!-- Additional Nested Level for Step 3 -->
                                                    <div class="accordion mt-3" id="frontend_coding_details">
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header">
                                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#frontend_coding_step_1" aria-expanded="false" aria-controls="frontend_coding_step_1">
                                                                    <i class="ri-terminal-line me-2"></i> Coding Practices
                                                                </button>
                                                            </h2>
                                                            <div id="frontend_coding_step_1" class="accordion-collapse collapse" data-bs-parent="#frontend_coding_details">
                                                                <div class="accordion-body">
                                                                    Follow best coding practices and use frameworks like Bootstrap.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End of Nested Level -->
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Frontend Step 3 Accordion -->
                                    </div>
                                    <!-- End of Nested Frontend Steps Accordion -->
                                </div>
                            </div>
                        </div>
                        <!-- End Frontend Development Accordion -->

                        <!-- Backend Development Accordion -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#step_2" aria-expanded="false" aria-controls="step_2">
                                    <i class="ri-braces-line me-2"></i> Backend Development
                                </button>
                            </h2>
                            <div id="step_2" class="accordion-collapse collapse" data-bs-parent="#main_accordion">
                                <div class="accordion-body">

                                    <!-- Nested Backend Steps Accordion -->
                                    <div class="accordion" id="backend_steps">

                                        <!-- Backend Step 1 Accordion -->
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#backend_step_1" aria-expanded="true" aria-controls="backend_step_1">
                                                    <i class="ri-database-line me-2"></i> Step 1: Setting Up
                                                </button>
                                            </h2>
                                            <div id="backend_step_1" class="accordion-collapse collapse show" data-bs-parent="#backend_steps">
                                                <div class="accordion-body">
                                                    Install and configure backend environment.

                                                    <!-- Additional Nested Level for Step 1 -->
                                                    <div class="accordion mt-3" id="backend_setup_details">
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header">
                                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#backend_setup_step_1" aria-expanded="false" aria-controls="backend_setup_step_1">
                                                                    <i class="ri-server-line me-2"></i> Server Setup
                                                                </button>
                                                            </h2>
                                                            <div id="backend_setup_step_1" class="accordion-collapse collapse" data-bs-parent="#backend_setup_details">
                                                                <div class="accordion-body">
                                                                    Install server frameworks and databases.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End of Nested Level -->
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Backend Step 1 Accordion -->

                                        <!-- Backend Step 2 Accordion -->
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#backend_step_2" aria-expanded="false" aria-controls="backend_step_2">
                                                    <i class="ri-server-line me-2"></i> Step 2: Building APIs
                                                </button>
                                            </h2>
                                            <div id="backend_step_2" class="accordion-collapse collapse" data-bs-parent="#backend_steps">
                                                <div class="accordion-body">
                                                    Develop and test APIs using tools like Postman.

                                                    <!-- Additional Nested Level for Step 2 -->
                                                    <div class="accordion mt-3" id="backend_api_details">
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header">
                                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#backend_api_step_1" aria-expanded="false" aria-controls="backend_api_step_1">
                                                                    <i class="ri-rest-time-line me-2"></i> API Testing
                                                                </button>
                                                            </h2>
                                                            <div id="backend_api_step_1" class="accordion-collapse collapse" data-bs-parent="#backend_api_details">
                                                                <div class="accordion-body">
                                                                    Use Postman to test API endpoints.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End of Nested Level -->
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Backend Step 2 Accordion -->
                                    </div>
                                    <!-- End of Nested Backend Steps Accordion -->
                                </div>
                            </div>
                        </div>
                        <!-- End Backend Development Accordion -->

                    </div>
                    <!-- End Main Accordion Wrapper -->
                </div>
                <!-- end card-body -->
            </div>
            <!--end::card-->
        </div>

        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0">Collapse Example</h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">
                        You can use a link with the <code>href</code> attribute, or a button with the <code>data-bs-target</code> attribute. In both cases, the <code>data-bs-toggle="collapse"</code> is required.
                    </p>

                    <!-- Collapsible Trigger Area -->
                    <div class="d-inline-flex gap-2 mb-3">
                        <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                            Link with href
                        </a>
                        <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                            Button with data-bs-target
                        </button>
                    </div>

                    <!-- Collapsible Content Area -->
                    <div class="collapse show" id="collapseExample">
                        <div class="card card-body mb-0 shadow-none bg-light bg-opacity-30 border border-dashed">
                            <h5 class="card-title">More Details</h5>
                            <p class="card-text">
                                Here’s some extra information that might be useful. For example, if you’re reading about a product, you could find details about its features, user instructions, or any other interesting facts. This part is hidden by default and will appear when you click either of the buttons above.
                            </p>
                        </div>
                    </div>

                </div>
                <!-- end card-body -->
            </div>
            <!--end::card-->
        </div>

        <div class="col-12 col-lg-6">
            <div class="card h-100 mb-0">
                <!--start::card-->
                <div class="card-header">
                    <h5 class="card-title mb-0">Horizontal Collapse</h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">Use the <code>collapse-horizontal</code> class to make elements slide open and closed horizontally, instead of vertically. Make sure to set a specific <code>width</code> on the child element that you want to collapse.</p>

                    <!-- Collapsible Trigger Area -->
                    <div class="d-inline-flex gap-2 mb-3">
                        <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWidthExample" aria-expanded="false" aria-controls="collapseWidthExample">
                            Toggle width collapse
                        </button>
                    </div>

                    <!-- Collapsible Content Area -->
                    <div class="collapse show collapse-horizontal" id="collapseWidthExample">
                        <p class="card mb-0 card-body w-300px shadow-none bg-light bg-opacity-30 border border-dashed">
                            This is some placeholder content for a horizontal collapse. It's hidden by default and shown when you click the button.
                        </p>
                    </div>

                </div>
                <!-- end card-body -->
            </div>
            <!--end::card-->
        </div>

        <div class="col-12">
            <div class="card h-100 mb-0">
                <div class="card-header">
                    <h5 class="card-title mb-0">Collapse with Icon</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">Click the icon to toggle the collapse.</p>

                    <!-- Collapsible Trigger Area with Remix Icon -->
                    <div class="d-flex flex-wrap gap-5 align-items-center mb-3">
                        <button class="btn btn-primary icon-btn custom-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#collapseContent" aria-expanded="false" aria-controls="collapseContent">
                            <span class="icon-on">
                                <i class="ri-subtract-line"></i>
                            </span>
                            <span class="icon-off">
                                <i class="ri-add-line"></i>
                            </span>
                        </button>
                        <div class="custom-toggle fw-semibold d-flex align-items-center" data-bs-toggle="collapse" data-bs-target="#collapseContent" aria-expanded="false" aria-controls="collapseContent" role="button">
                            <span class="icon-on">
                                Read Less
                                <i class="ri-arrow-up-s-line ms-2"></i>
                            </span>
                            <span class="icon-off">
                                Read More
                                <i class="ri-arrow-down-s-line ms-2"></i>
                            </span>
                        </div>
                    </div>

                    <!-- Collapsible Content Area -->
                    <div class="collapse show" id="collapseContent">
                        <div class="card card-body mb-0 shadow-none bg-light bg-opacity-30 border border-dashed">
                            This is some detailed content that gets revealed when you click "Read More" and hidden when you click "Read Less". Customize this text as needed for your application.
                        </div>
                    </div>
                </div>
            </div>
            <!--end::card-->
        </div>

        <div class="col-12">
            <div class="card h-100 mb-0">
                <!-- Start of Card -->
                <div class="card-header">
                    <h5 class="card-title mb-0">Controlling Multiple Collapses</h5>
                </div>
                <div class="card-body">

                    <p class="text-muted mb-4">
                        You can use a <code>&lt;button&gt;</code> or <code>&lt;a&gt;</code> to control multiple collapsible elements at once by using the same <code>data-bs-target</code> or <code>href</code> attribute. Similarly, a single <code>&lt;button&gt;</code> or <code>&lt;a&gt;</code> can control multiple collapsible elements if you use the same attribute value for all.
                    </p>

                    <!-- Collapsible Trigger Buttons -->
                    <div class="d-inline-flex gap-2 mb-3">
                        <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseOne" role="button" aria-expanded="false" aria-controls="collapseOne">Toggle First Section</a>
                        <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Toggle Second Section</button>
                        <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target=".multi-collapse" aria-expanded="false" aria-controls="collapseOne collapseTwo">Toggle Both Sections</button>
                    </div>

                    <!-- Collapsible Content Sections -->
                    <div class="row">
                        <div class="col">
                            <div class="collapse show multi-collapse" id="collapseOne">
                                <div class="card card-body mb-0 shadow-none bg-light bg-opacity-30 border border-dashed">
                                    This is the content for the first section. It’s hidden by default and will be shown when the appropriate button is clicked.
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="collapse show multi-collapse" id="collapseTwo">
                                <div class="card card-body mb-0 shadow-none bg-light bg-opacity-30 border border-dashed">
                                    This is the content for the second section. It’s hidden by default and will be shown when the appropriate button is clicked.
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- End of Card Body -->
            </div>
            <!--end::card-->
        </div>

    </div>
@endsection

@section('js')

    <!-- App js -->
    <script type="module" src="{{ asset('assets/js/app.js') }}"></script>

@endsection