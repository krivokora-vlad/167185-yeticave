      <nav class="nav">
        <ul class="nav__list container">
            <? foreach ($data['categories'] as $category): ?>
                <li class="nav__item">
                    <a href="#"><?=$category['name'];?></a>
                </li>
            <? endforeach; ?> 
        </ul>
    </nav>

    <section class="lot-item container">
      <h1><?=$data['title'];?></h1>
      <?=(isset($data['content'])) ? '<p>'.$data['content'].'</p>' : '';?>
    </section>