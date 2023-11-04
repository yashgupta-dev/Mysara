{assign var="title" value="welcome"}

{include file="frontend/common/header.tpl"}
{include file="frontend/common/menu.tpl"}  


{block name="front_page"}
<main id="main">

  <!-- ======= Breadcrumbs ======= -->
  <div class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2>Sample Inner Page</h2>
        <ol>
          <li><a href="index.html">Home</a></li>
          <li>Sample Inner Page</li>
        </ol>
      </div>

    </div>
  </div><!-- End Breadcrumbs -->

  <section class="sample-page">
    <div class="container" data-aos="fade-up">

      <p>
        You can duplicate this sample page and create any number of inner pages you like!
      </p>

    </div>
  </section>

</main><!-- End #main -->

{/block}
{include file="frontend/common/footer.tpl"}