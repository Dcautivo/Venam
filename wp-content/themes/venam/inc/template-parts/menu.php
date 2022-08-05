<?php

/*************************************************
## Register Menu
*************************************************/
/**
* Extended Walker class for use with the  Bootstrap toolkit Dropdown menus in Wordpress.
* Edited to support n-levels submenu and Title and Description text.
* @author @jaycbrf4 https://github.com/jaycbrf4/wp-bootstrap-navwalker
*  Original work by johnmegahan https://gist.github.com/1597994, Emanuele 'Tex' Tessore https://gist.github.com/3765640
* @license CC BY 4.0 https://creativecommons.org/licenses/by/4.0/
*/
if ( ! class_exists( 'Venam_Wp_Bootstrap_Navwalker' ) ) {
    class Venam_Wp_Bootstrap_Navwalker extends Walker_Nav_Menu
    {
        public function start_lvl(&$output, $depth = 0, $args = array())
        {
            $indent = str_repeat("\t", $depth);
            $submenu = ($depth > 0) ? '' : '';
            $output	.= "\n$indent<ul class=\"submenu depth_$depth\">\n";
        }
        public function end_lvl(&$output, $depth = 0, $args = array())
        {
            $output	.= "</ul>";
        }

        public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
        {
            $indent = ($depth) ? str_repeat("\t", $depth) : '';

            $li_attributes = '';
            $class_names = $value = '';

            $classes = empty($item->classes) ? array() : (array) $item->classes;

            // managing divider: add divider class to an element to get a divider before it.
            $divider_class_position = array_search('divider', $classes);

            if ($divider_class_position !== false) {
                $output .= "<li class=\"divider\"></li>\n";
                unset($classes[$divider_class_position]);
            }

            $classes[] = ($args->has_children) ? 'dropdown' : '';
            $classes[] = ($item->current || $item->current_item_ancestor) ? 'active' : '';
            $classes[] = 'menu-item-' . $item->ID;

            if ($depth && $args->has_children) {
                $classes[] = 'has-submenu menu-item--has-child';
            }

            $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
            $class_names = ' class="' . esc_attr($class_names) . '"';

            $id = apply_filters('nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args);
            $id = strlen($id) ? ' id="' . esc_attr($id) . '"' : '';

            $output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';

            $attributes  = ! empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) .'"' : '';
            $attributes .= ! empty($item->target) ? ' target="' . esc_attr($item->target) .'"' : '';
            $attributes .= ! empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) .'"' : '';
            $attributes .= ! empty($item->url) ? ' href="' . esc_attr($item->url) .'"' : '';


            /** This filter is documented in wp-includes/post-template.php */
            $title = apply_filters( 'the_title', $item->title, $item->ID );

            /**
             * Filters a menu item's title.
             *
             * @since 4.4.0
             *
             * @param string   $title The menu item's title.
             * @param WP_Post  $item  The current menu item.
             * @param stdClass $args  An object of wp_nav_menu() arguments.
             * @param int      $depth Depth of menu item. Used for padding.
             */
            $title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

            $shortcode = get_post_meta( $item->ID, '_menu_item_menushortcode', true );
            $hidetitle = get_post_meta( $item->ID, '_menu_item_menuhidetitle', true );
            if ( !empty($shortcode) ) {
                $item_output  = '';
                if ( 'yes' != $hidetitle ) {
                    $item_output .= $args->before;
                    $item_output .= '<a'. $attributes .'>';
                    $item_output .= $args->link_before . $title . $args->link_after;
                    $item_output .= '</a>';
                    $item_output .= $args->after;
                }
                $item_output .='<div class="item-shortcode-wrapper">' . do_shortcode( $shortcode ) . '</div>';
            } else {
                $item_output  = $args->before;
                $item_output .= '<a'. $attributes .'>';
                $item_output .= $args->link_before . $title . $args->link_after;
                $item_output .= '</a>';
                $item_output .= $args->after;
            }


            $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
        } // start_el

        public function display_element($element, &$children_elements, $max_depth, $depth, $args, &$output)
        {
            if (!$element) {
                return;
            }

            $id_field = $this->db_fields['id'];

            //display this element
            if (is_array($args[0])) {
                $args[0]['has_children'] = ! empty($children_elements[$element->$id_field]);
            } elseif (is_object($args[0])) {
                $args[0]->has_children = ! empty($children_elements[$element->$id_field]);
            }
            $cb_args = array_merge(array(&$output, $element, $depth), $args);
            call_user_func_array(array(&$this, 'start_el'), $cb_args);

            $id = $element->$id_field;

            // descend only when the depth is right and there are childrens for this element
            if (($max_depth == 0 || $max_depth > $depth+1) && isset($children_elements[$id])) {
                foreach ($children_elements[ $id ] as $child) {
                    if (!isset($newlevel)) {
                        $newlevel = true;

                        // start the child delimiter
                        $cb_args = array_merge(array(&$output, $depth), $args);
                        call_user_func_array(array(&$this, 'start_lvl'), $cb_args);
                    }

                    $this->display_element($child, $children_elements, $max_depth, $depth + 1, $args, $output);
                }

                unset($children_elements[ $id ]);
            }

            if (isset($newlevel) && $newlevel) {

            // end the child delimiter
                $cb_args = array_merge(array(&$output, $depth), $args);
                call_user_func_array(array(&$this, 'end_lvl'), $cb_args);
            }

            // end this element
            $cb_args = array_merge(array(&$output, $element, $depth), $args);
            call_user_func_array(array(&$this, 'end_el'), $cb_args);
        }

        /**
         * Menu Fallback
         *
         * @since 1.0.0
         *
         * @param array $args passed from the wp_nav_menu function.
         */
        public static function fallback($args)
        {
            if (current_user_can('edit_theme_options')) {
                echo '<li class="menu-item"><a href="' . admin_url('nav-menus.php') . '">' . esc_html__('Add a menu', 'venam') . '</a></li>';
            }
        }
    }
}


if ( !class_exists('Venam_Wc_Categories_Walker') ) {
    class Venam_Wc_Categories_Walker extends Walker
    {
        /**
        * DB fields to use.
        *
        * @var array
        */
        public $db_fields = array(
            'parent' => 'parent',
            'id'     => 'term_id',
            'slug'   => 'slug',
        );
        /**
        * Starts the list before the elements are added.
        *
        * @see Walker::start_lvl()
        * @since 2.1.0
        *
        * @param string $output Passed by reference. Used to append additional content.
        * @param int    $depth Depth of category. Used for tab indentation.
        * @param array  $args Will only append content if style argument value is 'list'.
        */
        public function start_lvl( &$output, $depth = 0, $args = array() ) {
            if ( 'list' !== $args['style'] ) {
                return;
            }

            $indent  = str_repeat( "\t", $depth );
            $output .= "$indent<ul class='venam-wc-cats-children submenu depth_$depth'>\n";
        }

        /**
        * Ends the list of after the elements are added.
        *
        * @see Walker::end_lvl()
        * @since 2.1.0
        *
        * @param string $output Passed by reference. Used to append additional content.
        * @param int    $depth Depth of category. Used for tab indentation.
        * @param array  $args Will only append content if style argument value is 'list'.
        */
        public function end_lvl( &$output, $depth = 0, $args = array() ) {
            if ( 'list' !== $args['style'] ) {
                return;
            }

            $indent  = str_repeat( "\t", $depth );
            $output .= "$indent</ul>\n";
        }

        /**
        * Start the element output.
        *
        * @see Walker::start_el()
        * @since 2.1.0
        *
        * @param string  $output            Passed by reference. Used to append additional content.
        * @param object  $cat               Category.
        * @param int     $depth             Depth of category in reference to parents.
        * @param array   $args              Arguments.
        * @param integer $current_object_id Current object ID.
        */
        public function start_el( &$output, $cat, $depth = 0, $args = array(), $current_object_id = 0 ) {
            $cat_id  = intval( $cat->term_id );

            $output .= '<li class="menu-item cat-item cat-item-' . $cat_id;

            if ( $args['current_category'] === $cat_id ) {
                $output .= ' current-cat';
            }

            if ( $args['has_children'] && $args['hierarchical'] && ( empty( $args['max_depth'] ) || $args['max_depth'] > $depth + 1 ) ) {
                $output .= ' menu-item-has-children dropdown cat-parent';
            }

            $output .= '">';
            $output .= '<a class="product_cat" href="'.esc_url( get_term_link( $cat_id ) ).'">'.$cat->name.'</a>';
        }

        /**
        * Ends the element output, if needed.
        *
        * @see Walker::end_el()
        * @since 2.1.0
        *
        * @param string $output Passed by reference. Used to append additional content.
        * @param object $cat    Category.
        * @param int    $depth  Depth of category. Not used.
        * @param array  $args   Only uses 'list' for whether should append to output.
        */
        public function end_el( &$output, $cat, $depth = 0, $args = array() ) {
            $output .= "</li>\n";
        }

        /**
        * Traverse elements to create list from elements.
        *
        * Display one element if the element doesn't have any children otherwise,
        * display the element and its children. Will only traverse up to the max.
        * depth and no ignore elements under that depth. It is possible to set the.
        * max depth to include all depths, see walk() method.
        *
        * This method shouldn't be called directly, use the walk() method instead.
        *
        * @since 2.5.0
        *
        * @param object $element           Data object.
        * @param array  $children_elements List of elements to continue traversing.
        * @param int    $max_depth         Max depth to traverse.
        * @param int    $depth             Depth of current element.
        * @param array  $args              Arguments.
        * @param string $output            Passed by reference. Used to append additional content.
        * @return null Null on failure with no changes to parameters.
        */
        public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
            if ( ! $element || ( 0 === $element->count && ! empty( $args[0]['hide_empty'] ) ) ) {
                return;
            }
            parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
        }
    }
}
