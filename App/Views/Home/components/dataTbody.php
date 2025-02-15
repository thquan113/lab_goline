<?php
foreach ($data as $item) { ?>
    <tr>
        <td>
            <img decoding="async" src="/public/assets//images/product1.jpeg" alt="" width="100" class="m-3">
        </td>
        <td>
            <p class="fw-bold"><?= $item['title'] ?></p>
            <p>
                <?= 'ID: ' . $item['id'] . ' / ' . $item['address'] . ' / ' . $item['city'] . ' / ' . $item['description'] ?>
            </p>
        </td>
        <td>
            <div class="d-flex <?= $item['price_d'] == 0 || $item['price_d'] == 0 ? '' : 'gap-2' ?>">
                <span><?= $item['price_d'] == 0 ? '' : $item['price_d'] . '/Day' ?></span>
                <span><?= $item['price_m'] == 0 ? '' : $item['price_m'] . '/Month' ?></span>
            </div>
        </td>
        <td><span class="badge rounded-pill bg-success">On</span></td>
        <td>
            <div class="d-flex align-items-center gap-2">
                <button type="button" class="btn btn-outline-primary "><i class="bi bi-eye"></i>
                    Detail</button>
                <span class="text-primary"><i class="bi bi-three-dots-vertical"></i></span>
            </div>
        </td>
    </tr>
<?php } ?>