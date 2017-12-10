      <nav class="nav">
        <ul class="nav__list container">
            <? foreach ($data['categories'] as $key => $value): ?>
                <li class="nav__item">
                    <a href="#"><?=$value;?></a>
                </li>
            <? endforeach; ?> 
        </ul>
    </nav>

    <section class="lot-item container">
      <h1><?=$data['title'];?></h1>
      <?=(isset($data['content'])) ? '<p>'.$data['content'].'</p>' : '';?>
    </section>