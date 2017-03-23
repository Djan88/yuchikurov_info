<?php do_action( 'bp_before_profile_loop_content' ); ?>

<?php if ( bp_has_profile() ) : ?>

	<?php while ( bp_profile_groups() ) : bp_the_profile_group(); ?>

		<?php if ( bp_profile_group_has_fields() ) : ?>

			<?php do_action( 'bp_before_profile_field_content' ); ?>

			<div class="bp-widget <?php bp_the_profile_group_slug(); ?>">				

				<table class="profile-fields table table-bordered table-striped effect-fade in" data-effect="fade" style="transition: all 0.7s ease-in-out;">

					<?php while ( bp_profile_fields() ) : bp_the_profile_field(); ?>

						<?php if ( bp_field_has_data() ) : ?>
                                                        
                                                        <?php if((bp_get_the_profile_field_name() !== 'Имя Фамилия') && (bp_get_the_profile_field_name() !== 'О себе (не более 100 символов)') && (bp_get_the_profile_field_name() !== 'vkontakte') && (bp_get_the_profile_field_name() !== 'facebook') && (bp_get_the_profile_field_name() !== 'youtube') && (bp_get_the_profile_field_name() !== 'YouTube видео') && (bp_get_the_profile_field_name() !== 'Семинары') && (bp_get_the_profile_field_name() !== 'Приемные дни')){ ?>

                                                            <tr<?php bp_field_css_class(); ?>>

                                                                    <td class="label"><?php bp_the_profile_field_name(); ?></td>
                                                                    
                                                                    <?php if(bp_get_the_profile_field_name() == 'Web сайт') { 
                                                                    
                                                                        $val = substr(bp_get_the_profile_field_value(),3,-5);
                                                                        
                                                                        ?>

                                                                    <td class="data"><?php echo $val; ?></td>
                                                                    
                                                                    <?php } else{ ?>
                                                                    
                                                                    <td class="data"><?php bp_the_profile_field_value(); ?></td>
                                                                    
                                                                    <?php } ?>
                                                                    
                                                            </tr>
                                                        
                                                        <?php } ?>

						<?php endif; ?>

						<?php do_action( 'bp_profile_field_item' ); ?>

					<?php endwhile; ?>

				</table>
			</div>

			<?php do_action( 'bp_after_profile_field_content' ); ?>

		<?php endif; ?>

	<?php endwhile; ?>

	<?php do_action( 'bp_profile_field_buttons' ); ?>

<?php endif; ?>

<?php do_action( 'bp_after_profile_loop_content' ); ?>
