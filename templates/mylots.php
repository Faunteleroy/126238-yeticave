<?=$main_nav;?>
<section class="rates container">
    <h2>Мои ставки</h2>
    <table class="rates__list">
        <?php foreach ($my_bets as $key => $val): ?>
        <tr class="rates__item">
            <td class="rates__info">
                <div class="rates__img">
                    <img src="<?=$val['img'];?>" width="54" height="40" alt="<?=htmlspecialchars($val['name']);?>">
                </div>
                <h3 class="rates__title"><a href="/lot.php?id=<?=$val['id'];?>"><?=htmlspecialchars($val['name']);?></a></h3>
            </td>
            <td class="rates__category">
                <?=$val['category'];?>
            </td>
            <td class="rates__timer">
                <div class="timer timer--finishing">07:13:34</div>
            </td>
            <td class="rates__price">
                <?=$val['price'];?>
            </td>
            <td class="rates__time">
                <?=bets_time($val['time']);?>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</section>
