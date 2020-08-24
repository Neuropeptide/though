<?php

require_once "./../src/config.php";

$pageTitle = "Services";
$pageDescription= "You have a project ? This is how we can help you";
$pageClassName = "page-services";

?>


<?php require_once "./../src/templates/page-start.php" ?>

<?php
    require_once '../src/templates/header.php';
    require_once '../src/templates/intro.php';
?>

<section>
    <div class="container">
        <h1 class="title">Here are the services we offer</h1>

        <div id="interior" class="service">
            <img class="service-picto" src="./img/interior.svg" alt="" />

            <div>
                <h3 class="service-title title">Interior Design</h3>

                <p class="service-content">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. At
                    ullam dignissimos aut eum, et libero nostrum quae voluptatum
                    nesciunt totam nemo necessitatibus odio ex, quam quia iste
                    laboriosam consequuntur quisquam!
                </p>

                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad adipisci assumenda commodi, consectetur consequuntur debitis deserunt dignissimos dolorem ducimus ex maiores molestias odio quas quidem quo sunt tenetur voluptatem? Beatae quae quam vero! Ab adipisci asperiores at autem consequuntur deserunt dicta error et ex impedit in, ipsam iusto maiores nihil non nostrum, numquam obcaecati odio omnis pariatur perferendis, praesentium quasi sunt unde voluptatum. Ad, alias aspernatur, atque autem dolore eveniet fugit nam necessitatibus quaerat quas sint tempore temporibus voluptate voluptates.
                </p>
            </div>
        </div>

        <div id="concept" class="service">
            <img class="service-picto" src="./img/ideas.svg" alt="" />

            <div>
                <h3 class="service-title title">Concept</h3>

                <p class="service-content">
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                    Eveniet, fuga dolor, reprehenderit eligendi voluptatum
                    aspernatur quisquam asperiores dolorem pariatur corrupti,
                    exercitationem vitae nemo.
                </p>

                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium beatae cum eaque, eligendi enim facilis non nulla odio temporibus voluptates! A accusamus adipisci cumque debitis dolorum eaque eius enim, error ipsa iste iure labore laudantium maxime minima mollitia neque numquam officiis optio quam quia quos sunt suscipit tempora temporibus unde veritatis voluptates voluptatibus! Ab consequuntur doloremque dolores eius eos error est expedita molestiae nam officiis optio provident quaerat quo, quos voluptatibus? Cupiditate debitis dolore molestias pariatur praesentium reiciendis rem sapiente!
                </p>
            </div>
        </div>

        <div id="residential" class="service">
            <img class="service-picto" src="./img/modern-house.svg" alt="" />

            <div>
                <h3 class="service-title title">Residential</h3>

                <p class="service-content">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                    Maiores, vel eius labore deleniti expedita est pariatur
                    doloribus. Tempore eius, modi est accusantium ab natus nihil
                    earum delectus voluptatem, explicabo suscipit. Dolorum molestias
                    harum, fuga voluptatem, dolor ad, voluptatibus saepe illo
                    explicabo vel illum at perferendis aut consequuntur. Minus, quo
                    cupiditate! Rerum quasi quam facere molestias aliquam?
                </p>

                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda cum eaque ex expedita ipsa nihil soluta tempore. A amet blanditiis consectetur cumque delectus dicta enim ex, incidunt numquam perspiciatis quod quos sapiente voluptatum. Ad animi assumenda debitis deleniti dignissimos distinctio dolor, ducimus esse, eum expedita facere hic illo impedit in ipsa, ipsam ipsum magnam minus natus nihil numquam pariatur possimus praesentium quae quasi quis quod rem repellat saepe sed tempora totam vel voluptatem? Expedita pariatur quas sapiente sequi, unde voluptates!
                </p>
            </div>
        </div>

        <div id="hospitality" class="service">
            <img class="service-picto" src="./img/skyline.svg" alt="" />

            <div>
                <h3 class="service-title title">Hospitality</h3>

                <p class="service-content">
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                    Nostrum commodi odit obcaecati quaerat excepturi, sapiente
                    mollitia doloribus nulla hic perferendis debitis nam blanditiis
                    quisquam! Beatae officia eaque repudiandae odio et.
                </p>

                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. A adipisci aliquid aut debitis dolore doloribus error facilis hic id incidunt ipsam itaque magni, maiores, minima molestiae nemo numquam pariatur placeat quam quod ratione recusandae tempore unde voluptates voluptatum. Dolore eaque itaque mollitia nam quaerat, soluta ut. Ab deserunt ducimus eius libero maxime minus molestias provident voluptas. Amet corporis earum excepturi expedita itaque iure maxime mollitia natus necessitatibus neque, numquam odit provident quidem rem rerum soluta vel voluptas voluptatibus? Numquam, voluptates.
                </p>
            </div>
        </div>
    </div>
</section>
<!-- // services -->


<?php require_once "./../src/templates/page-end.php" ?>


