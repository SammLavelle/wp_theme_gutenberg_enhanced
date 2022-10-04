<?php
/**
 * Block Name: Tabbed Content
 *
 * This is the template that displays the tabbed content block.
 */

// create id attribute for specific styling
$id = 'tabs-' . $block['id'];

// create align class ("alignwide") from block setting ("wide")
$align_class = $block['align'] ? 'align' . $block['align'] : '';


?>

<div id="<?php echo $id; ?>" class=" <?php echo $align_class; ?> custom-block tab-block">
    <ul>
        <?php 
        $counter= 0; 
        while(have_rows('tabs')): the_row();
        $counter++; ?>
            <li>
                <a href="#section<?php echo $counter; ?>"><?php the_sub_field('tab_label'); ?></a>
            </li>
        <?php endwhile; ?>
    </ul>
   
    <?php 
    $counter= 0; 
    while(have_rows('tabs')): the_row();
    $counter++; ?>
        <section id="section<?php echo $counter; ?>">
           <?php the_sub_field('tab_content'); ?>
        </section>
    <?php endwhile; ?>
</div>