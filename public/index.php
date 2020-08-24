<?php

require_once "./../src/config.php";
require_once __DIR__ . "/../src/database/connection.php";


$pageTitle = "[Tough] | Architect agency";
$pageDescription= "We are Tough a modern architect agency, specialized in building skyscrapers, but we can do many other things !";

// Récupérer 2 feedback depuis la BDD
$results = $database->query("SELECT * FROM feedbacks ORDER BY created_on DESC, id DESC LIMIT 2");
// et les stocker dans un tableau PHP
$feedbacks = $results->fetchAll(PDO::FETCH_ASSOC);



// Récupérer les 10 projets les plus récents depuis la BDD
// (requete avec un alias pour les tables, ce qui ne change rien, c'est juste pour le développeur)
$results = $database->query("SELECT p.id, p.title, p.picture, s.name as serviceName
FROM projects p
    JOIN services s 
        ON p.service_id = s.id 
ORDER BY released_on DESC 
LIMIT 10");
// et les stocker dans un tableau PHP
$projects = $results->fetchAll(PDO::FETCH_ASSOC);


$results = $database->query("SELECT
       services.id,
       services.name,
       services.picture,
       services.description,
       COUNT(services.id) as projectCount
FROM services
    JOIN projects
    ON services.id = projects.service_id
GROUP BY services.id");

$services = $results->fetchAll(PDO::FETCH_ASSOC);


?>

<?php require_once "./../src/templates/page-start.php" ?>

    <?php require_once '../src/templates/header.php' ?>
    <?php require_once '../src/templates/intro.php' ?>

    <section id="kpis">
      <div class="container kpis-container">
        <div class="kpis-grid">
          <div class="kpi">
            <p class="kpi-number">800</p>
            <p class="kpi-label">Finished Projects</p>
          </div>

          <div class="kpi">
            <p class="kpi-number">795</p>
            <p class="kpi-label">Happy Customers</p>
          </div>

          <div class="kpi">
            <p class="kpi-number">1200</p>
            <p class="kpi-label">Working hours</p>
          </div>

          <div class="kpi">
            <p class="kpi-number">850</p>
            <p class="kpi-label">Cups of coffe</p>
          </div>
        </div>

        <div class="explore">
          <a href="#" class="btn btn-light">
            Explore Further
          </a>
        </div>
      </div>
    </section>
    <!-- // kpis -->

    <section id="services">
      <div class="container">
        <div class="row">
          <div class="services-menu">

            <h2 class="title">Services</h2>

            <nav id="services-menu">

                <ul>
                   <?php foreach ($services as $k => $service): ?>
                    <li>
                        <a href="" data-link="<?php echo strtolower($service['name']) ?>" class="service-link <?= $k === 0 ? 'active' : ''?>">
                            <?php echo $service['name'] ?>
                            <sup class="projects-count">
                                <?= $service['projectCount'] ?>
                            </sup>
                        </a>
                    </li>
                   <?php endforeach ?>
                </ul>

            </nav>
          </div>

          <div class="services-container">

              <?php foreach ($services as $k => $service): ?>
                  <div data-service="<?= strtolower($service['name']) ?>" class="service <?= $k === 0 ? 'active' : ''?>">
                      <img class="service-picto" src="./img/<?= $service['picture'] ?>" alt="Pictogramme représentant le service <?= $service['name'] ?>"/>

                      <h3 class="service-title"><?= $service['name'] ?></h3>

                      <p class="service-content">
                          <?= $service['description'] ?>
                      </p>

                      <a href="what-we-do" class="btn btn-dark">Learn more</a>
                  </div>
              <?php endforeach ?>


          </div>
        </div>
      </div>
    </section>
    <!-- // services -->

    <section id="portfolio">
      <div class="container">

        <div class="grid">
          <div>
            <h2 class="title">Portfolio</h2>

            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit.
              Aspernatur soluta dolore aperiam maiores!
            </p>
          </div>

            <?php require "../src/templates/portfolio-grid.php" ?>
        </div>
      </div>
    </section>


    <?php if (!empty($feedbacks)): ?>
        <section id="feedbacks">
          <div class="container feedbacks-container">
            <div class="feedbacks-content">
              <h2 class="title">Clients say</h2>

              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt, culpa
                non voluptas tempora alias incidunt assumenda dolore laborum
                voluptate aliquam unde qui odit harum? Ea nisi officia error at
                maiores?
              </p>
            </div>

            <div class="feedbacks-carousel">

            <?php foreach ($feedbacks as $feedback):
                include __DIR__ . '/../src/templates/feedback.php';
            endforeach; ?>

            </div>
          </div>
        </section>
    <!-- // feedbacks -->
    <?php endif; ?>

    <section id="plans">
      <div class="container">
        <div class="row">
          <article class="plan">
            <h4>Basic Plan</h4>

            <p>
              Lorem ipsum dolor sit, amet consectetur adipisicing elit. At sunt
              fugit amet corporis!
            </p>

            <p class="plan-price">
              <span>$29</span>
              per month
            </p>

            <a href="" class="btn btn-dark">Get started</a>

            <p>
              Open source
            </p>
          </article>

          <article class="plan">
            <h4>Standard Plan</h4>

            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit.
              Perspiciatis voluptatibus sequi cupiditate minus alias. Quibusdam
              soluta temporibus adipisci sequi autem! Quas, quos? At accusantium
              similique laborum nesciunt vitae. Accusamus, iure?
            </p>

            <p class="plan-price">
              <span>$49</span>
              per month
            </p>

            <a href="" class="btn btn-dark">Get started</a>

            <p>
              free 30 days trial
            </p>
          </article>

          <article class="plan">
            <h4>Premium Plan</h4>

            <p>
              Lorem ipsum, dolor sit amet consectetur adipisicing elit. Modi
              iste temporibus in magnam aliquam. Animi impedit voluptatum
              possimus, et voluptates vitae repudiandae minus deserunt laborum
              debitis natus in magnam non?
            </p>

            <p class="plan-price">
              <span>$89</span>
              per month
            </p>

            <a href="" class="btn btn-dark">Get started</a>

            <p>
              Request a quote
            </p>
          </article>
        </div>
      </div>
    </section>
    <!-- // plans -->





<?php require_once './../src/templates/page-end.php' ?>

           
