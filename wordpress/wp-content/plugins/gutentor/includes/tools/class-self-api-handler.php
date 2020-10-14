<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! class_exists( 'Gutentor_Self_Api_Handler' ) ) {
	/**
	 * Advanced Import
	 *
	 * @package Gutentor
	 * @since 1.0.1
	 */
	class Gutentor_Self_Api_Handler extends WP_Rest_Controller {

		/**
		 * Rest route namespace.
		 *
		 * @var Gutentor_Self_Api_Handler
		 */
		public $namespace = 'gutentor-self-api/';

		/**
		 * Rest route version.
		 *
		 * @var Gutentor_Self_Api_Handler
		 */
		public $version = 'v1';

		/**
		 * Initialize the class
		 */
		public function run() {
			add_action( 'rest_api_init', array( $this, 'register_routes' ) );
		}

		/**
		 * Register REST API route
		 */
		public function register_routes() {
			$namespace = $this->namespace . $this->version;

			register_rest_route(
				$namespace,
				'/max_num_pages',
				array(
					array(
						'methods'             => \WP_REST_Server::READABLE,
						'callback'            => array( $this, 'max_num_pages' ),
						'permission_callback' => function () {
							return current_user_can( 'edit_posts' );
						},
					),
				)
			);
			register_rest_route(
				$namespace,
				'/gadvancedb',
				array(
					array(
						'methods'  => \WP_REST_Server::READABLE,
						'callback' => array( $this, 'gadvancedb' ),
						'args'     => array(
							'paged'   => array(
								'type'              => 'number',
								'required'          => true,
								'description'       => __( 'Page Number (Paged) ', 'gutentor' ),
								'sanitize_callback' => 'absint',
							),
							'blockId' => array(
								'type'              => 'string',
								'required'          => true,
								'description'       => __( 'Block ID', 'gutentor' ),
								'sanitize_callback' => 'sanitize_text_field',
							),
							'postId'  => array(
								'type'              => 'number',
								'required'          => true,
								'description'       => __( 'Block ID', 'gutentor' ),
								'sanitize_callback' => 'sanitize_text_field',
							),
						),
                        'permission_callback' => '__return_true',
					),
				)
			);

			register_rest_route(
				$namespace,
				'/tax',
				array(
					array(
						'methods'             => \WP_REST_Server::READABLE,
						'callback'            => array( $this, 'tax' ),
						'permission_callback' => function () {
							return current_user_can( 'edit_posts' );
						},
					),
				)
			);

			register_rest_route(
				$namespace,
				'/tex_terms',
				array(
					array(
						'methods'             => \WP_REST_Server::READABLE,
						'callback'            => array( $this, 'tex_terms' ),
						'permission_callback' => function () {
							return current_user_can( 'edit_posts' );
						},
						'args'                => array(
							'tax' => array(
								'type'              => 'string',
								'required'          => true,
								'description'       => __( 'Taxonomy', 'gutentor' ),
								'sanitize_callback' => 'sanitize_text_field',
							),
						),

					),
				)
			);

			register_rest_route(
				$namespace,
				'/get_posts',
				array(
					array(
						'methods'             => \WP_REST_Server::READABLE,
						'callback'            => array( $this, 'get_posts' ),
						'permission_callback' => array( $this, 'get_posts_permissions_check' ),
					),
				)
			);
		}

		/**
		 * Function to fetch templates.
		 *
		 * @return int
		 */
		public function max_num_pages( \WP_REST_Request $request ) {
			$query_args = array(
				'posts_per_page'      => $request->get_param( 'posts_per_page' ) ? $request->get_param( 'posts_per_page' ) : 6,
				'post_type'           => $request->get_param( 'post_type' ) ? $request->get_param( 'post_type' ) : 'post',
				'orderby'             => $request->get_param( 'orderby' ) ? $request->get_param( 'orderby' ) : 'date',
				'order'               => $request->get_param( 'order' ) ? $request->get_param( 'order' ) : 'desc',
				'paged'               => $request->get_param( 'paged' ) ? $request->get_param( 'paged' ) : 1,
				'ignore_sticky_posts' => true,
				'post_status'         => 'publish',
			);
			if ( $request->get_param( 'taxonomy' ) &&
				$request->get_param( 'term' ) ) {
				$query_args['tax_query'] = array(
					array(
						'taxonomy' => $request->get_param( 'taxonomy' ),
						'field'    => 'id',
						'terms'    => explode( ',', $request->get_param( 'term' ) ),
					),
				);
			}

			if ( $request->get_param( 'offset' ) && ! ( $query_args > 1 ) ) {
				$query_args['offset'] = $request->get_param( 'offset' ) ? $request->get_param( 'offset' ) : 0;
			}
			if ( $request->get_param( 'post__in' ) ) {
				$query_args['post__in'] = explode( ',', $request->get_param( 'post__in' ) );
			}
			if ( $request->get_param( 'post__not_in' ) ) {
				$query_args['post__not_in'] = explode( ',', $request->get_param( 'post__not_in' ) );
			}
			// the query
			$the_query = new WP_Query( $query_args );
			wp_reset_postdata();
			return rest_ensure_response( $the_query->max_num_pages );
		}
		/**
		 * Function to fetch templates.
		 *
		 * @return array|bool|\WP_Error
		 */
		public function gadvancedb( \WP_REST_Request $request ) {

			$paged    = $request->get_param( 'paged' );
			$blockId  = $request->get_param( 'blockId' );
			$postId   = $request->get_param( 'postId' );
			$taxonomy = $request->get_param( 'gTax' );
			$term     = $request->get_param( 'gTerm' );
			$innerBlockType    = $request->get_param( 'innerBlockType' );

			if ( $paged ) {
				$post = get_post( $postId );
				if ( has_blocks( $post->post_content ) ) {
					$blocks  = parse_blocks( $post->post_content );
					$pBlock = gutentor_get_block_by_id( $blocks, $blockId );

					/*Get Default Attributes*/
                    if( 'gutentor/p6' == $innerBlockType ){
                        $p_attr          = Gutentor_P6::get_instance()->get_attrs();
                    }
                    else{
                        $p_attr          = Gutentor_P1_Blog::get_instance()->get_attrs();
                    }
					$common_attr      = gutentor_block_base()->get_common_attrs();
					$default_pre_attr = array_merge( $p_attr, $common_attr );
					$default_attr     = array();
					foreach ( $default_pre_attr as $key => $value ) {
						if ( isset( $value['default'] ) ) {
							$default_attr[ $key ] = $value['default'];
						}
					}
					$final_attrs          = array_merge( $default_attr, $pBlock['attrs'] );
					$final_attrs['paged'] = $paged;
                    if ( $term != 'default' ) {
                        if ( $term != 'gAll' ) {
                            $final_attrs['pTaxType'] = $taxonomy;
                            $final_attrs['pTaxTerm'] = $term;
                        } else {
                            $final_attrs['pTaxType'] = '';
                            $final_attrs['pTaxTerm'] = '';
                        }
                    }

					$response = array();

                    if( 'gutentor/p6' == $innerBlockType ){
                        $response['pBlog'] = Gutentor_P6::get_instance()->render_callback( $final_attrs, '' );
                    }
                    else{
                        $response['pBlog'] = Gutentor_P1_Blog::get_instance()->render_callback( $final_attrs, '' );
                    }

					/*
					max num of pages
					taken from class p1
					*/
					// the query
                    $query_args = array(
                        'posts_per_page'      => isset( $final_attrs['postsToShow'] ) ? $final_attrs['postsToShow'] : 6,
                        'post_type'           => isset( $final_attrs['pPostType'] ) ? $final_attrs['pPostType'] : 'post',
                        'orderby'             => isset( $final_attrs['orderBy'] ) ? $final_attrs['orderBy'] : 'date',
                        'order'               => isset( $final_attrs['order'] ) ? $final_attrs['order'] : 'desc',
                        'paged'               => isset( $final_attrs['paged'] ) ? $final_attrs['paged'] : 1,
                        'ignore_sticky_posts' => true,
                        'post_status'         => 'publish',
                    );

                    if ( isset( $final_attrs['offset'] ) && ! empty( $query_args['paged'] > 1 ) ) {
                        $query_args['offset'] = $final_attrs['offset'];
                    }
                    if ( isset( $final_attrs['pIncludePosts'] ) && ! empty( $final_attrs['pIncludePosts'] ) ) {
                        $query_args['post__in'] = $final_attrs['pIncludePosts'];
                    }
                    if ( isset( $final_attrs['pExcludePosts'] ) && ! empty( $final_attrs['pExcludePosts'] ) ) {
                        $query_args['post__not_in'] = $final_attrs['pExcludePosts'];
                    }

					if ( isset( $final_attrs['pTaxType'] ) && ! empty( $final_attrs['pTaxType'] ) &&
						isset( $final_attrs['pTaxTerm'] ) && ! empty( $final_attrs['pTaxTerm'] ) ) {

						$query_args['taxonomy'] = $final_attrs['pTaxType'];

						if ( is_array( $final_attrs['pTaxTerm'] ) ) {
							$p_terms = array();
							foreach ( $final_attrs['pTaxTerm'] as $p_term ) {
								$p_terms [] = $p_term['value'];
							}
							$query_args['term'] = $p_terms;
						} elseif ( is_string( $final_attrs['pTaxTerm'] ) || is_numeric( $final_attrs['pTaxTerm'] ) ) {
							$query_args['term'] = $final_attrs['pTaxTerm'];
						}
					}
					$the_query = new WP_Query( gutentor_get_query( $query_args ) );
					wp_reset_postdata();
					$max_num_pages             = $the_query->max_num_pages;
					$response['max_num_pages'] = $max_num_pages;
					$response['pagination']    = gutentor_pagination( $paged, $max_num_pages );

					return rest_ensure_response( $response );
				}
			}
		}

		/**
		 * Function to fetch tax terms.
		 */
		public function tax( \WP_REST_Request $request ) {
			$post_type  = $request->get_param( 'post_type' );
			$taxonomies = get_object_taxonomies( $post_type );
			return rest_ensure_response( $taxonomies );
		}

		/**
		 * Function to fetch tax terms.
		 */
		public function tex_terms( \WP_REST_Request $request ) {
			$tax       = $request->get_param( 'tax' );
			$tex_terms = get_terms(
				array(
					'taxonomy' => $tax,
				)
			);
			if ( ! empty( $tex_terms ) ) :
				return rest_ensure_response( $tex_terms );
			endif;
			return rest_ensure_response( false );
		}

		/**
		 * Checks if a given request has access to read posts.
		 *
		 * @since 2.1.3
		 *
		 * @param WP_REST_Request $request Full details about the request.
		 * @return true|WP_Error True if the request has read access, WP_Error object otherwise.
		 */
		public function get_posts_permissions_check( $request ) {

			$post_type = get_post_type_object( $request->get_param( 'post_type' ) );

			if ( 'edit' === $request['context'] && ! current_user_can( $post_type->cap->edit_posts ) ) {
				return new WP_Error(
					'rest_forbidden_context',
					__( 'Sorry, you are not allowed to edit posts in this post type.' ),
					array( 'status' => rest_authorization_required_code() )
				);
			}

			return true;
		}

		/**
		 * Prepares links for the request.
		 *
		 * @since 4.7.0
		 *
		 * @param WP_Post $post Post object.
		 * @return array Links for the given post.
		 */
		public function prepare_links( $post ) {
			$base = sprintf( '%s/%s', $this->namespace, $this->rest_base );

			// Entity meta.
			$links = array(
				'self'       => array(
					'href' => rest_url( trailingslashit( $base ) . $post->ID ),
				),
				'collection' => array(
					'href' => rest_url( $base ),
				),
				'about'      => array(
					'href' => rest_url( 'wp/v2/types/' . $post->post_type ),
				),
			);

			if ( ( in_array( $post->post_type, array( 'post', 'page' ), true ) || post_type_supports( $post->post_type, 'author' ) )
				&& ! empty( $post->post_author ) ) {
				$links['author'] = array(
					'href'       => rest_url( 'wp/v2/users/' . $post->post_author ),
					'embeddable' => true,
				);
			}

			if ( in_array( $post->post_type, array( 'post', 'page' ), true ) || post_type_supports( $post->post_type, 'comments' ) ) {
				$replies_url = rest_url( 'wp/v2/comments' );
				$replies_url = add_query_arg( 'post', $post->ID, $replies_url );

				$links['replies'] = array(
					'href'       => $replies_url,
					'embeddable' => true,
				);
			}

			if ( in_array( $post->post_type, array( 'post', 'page' ), true ) || post_type_supports( $post->post_type, 'revisions' ) ) {
				$revisions       = wp_get_post_revisions( $post->ID, array( 'fields' => 'ids' ) );
				$revisions_count = count( $revisions );

				$links['version-history'] = array(
					'href'  => rest_url( trailingslashit( $base ) . $post->ID . '/revisions' ),
					'count' => $revisions_count,
				);

				if ( $revisions_count > 0 ) {
					$last_revision = array_shift( $revisions );

					$links['predecessor-version'] = array(
						'href' => rest_url( trailingslashit( $base ) . $post->ID . '/revisions/' . $last_revision ),
						'id'   => $last_revision,
					);
				}
			}

			$post_type_obj = get_post_type_object( $post->post_type );

			if ( $post_type_obj->hierarchical && ! empty( $post->post_parent ) ) {
				$links['up'] = array(
					'href'       => rest_url( trailingslashit( $base ) . (int) $post->post_parent ),
					'embeddable' => true,
				);
			}

			// If we have a featured media, add that.
			$featured_media = get_post_thumbnail_id( $post->ID );
			if ( $featured_media ) {
				$image_url = rest_url( 'wp/v2/media/' . $featured_media );

				$links['https://api.w.org/featuredmedia'] = array(
					'href'       => $image_url,
					'embeddable' => true,
				);
			}

			if ( ! in_array( $post->post_type, array( 'attachment', 'nav_menu_item', 'revision' ), true ) ) {
				$attachments_url = rest_url( 'wp/v2/media' );
				$attachments_url = add_query_arg( 'parent', $post->ID, $attachments_url );

				$links['https://api.w.org/attachment'] = array(
					'href' => $attachments_url,
				);
			}

			$taxonomies = get_object_taxonomies( $post->post_type );

			if ( ! empty( $taxonomies ) ) {
				$links['https://api.w.org/term'] = array();

				foreach ( $taxonomies as $tax ) {
					$taxonomy_obj = get_taxonomy( $tax );

					// Skip taxonomies that are not public.
					if ( empty( $taxonomy_obj->show_in_rest ) ) {
						continue;
					}

					$tax_base = ! empty( $taxonomy_obj->rest_base ) ? $taxonomy_obj->rest_base : $tax;

					$terms_url = add_query_arg(
						'post',
						$post->ID,
						rest_url( 'wp/v2/' . $tax_base )
					);

					$links['https://api.w.org/term'][] = array(
						'href'       => $terms_url,
						'taxonomy'   => $tax,
						'embeddable' => true,
					);
				}
			}

			return $links;
		}
		/**
		 * Checks the post_date_gmt or modified_gmt and prepare any post or
		 * modified date for single post output.
		 *
		 * @since 4.7.0
		 *
		 * @param string      $date_gmt GMT publication time.
		 * @param string|null $date     Optional. Local publication time. Default null.
		 * @return string|null ISO8601/RFC3339 formatted datetime.
		 */
		protected function prepare_date_response( $date_gmt, $date = null ) {
			// Use the date if passed.
			if ( isset( $date ) ) {
				return mysql_to_rfc3339( $date );
			}

			// Return null if $date_gmt is empty/zeros.
			if ( '0000-00-00 00:00:00' === $date_gmt ) {
				return null;
			}

			// Return the formatted datetime.
			return mysql_to_rfc3339( $date_gmt );
		}
		/**
		 * Prepares a single post output for response.
		 * Copied from WP_REST_Posts_Controller->prepare_item_for_response
		 *
		 * @since 2.1.3
		 *
		 * @param WP_Post         $post    Post object.
		 * @param WP_REST_Request $request Request object.
		 * @return WP_REST_Response Response object.
		 */
		public function prepare_item_for_response( $post, $request ) {
			$GLOBALS['post'] = $post;

			setup_postdata( $post );

			// Base fields for every post.
			$data = array();
			/*ID*/
			$data['id'] = $post->ID;

			/*date*/
			$data['date'] = $this->prepare_date_response( $post->post_date_gmt, $post->post_date );

			/*Date GMT*/
			if ( '0000-00-00 00:00:00' === $post->post_date_gmt ) {
				$post_date_gmt = get_gmt_from_date( $post->post_date );
			} else {
				$post_date_gmt = $post->post_date_gmt;
			}
			$data['date_gmt'] = $this->prepare_date_response( $post_date_gmt );

			/*Date guid*/
			$data['guid'] = array(
				/** This filter is documented in wp-includes/post-template.php */
				'rendered' => apply_filters( 'get_the_guid', $post->guid, $post->ID ),
				'raw'      => $post->guid,
			);

			/*Date modified*/
			$data['modified'] = $this->prepare_date_response( $post->post_modified_gmt, $post->post_modified );

			/*Modified GMT*/
			if ( '0000-00-00 00:00:00' === $post->post_modified_gmt ) {
				$post_modified_gmt = gmdate( 'Y-m-d H:i:s', strtotime( $post->post_modified ) - ( get_option( 'gmt_offset' ) * 3600 ) );
			} else {
				$post_modified_gmt = $post->post_modified_gmt;
			}
			$data['modified_gmt'] = $this->prepare_date_response( $post_modified_gmt );

			/*Passeord*/
			$data['password'] = $post->post_password;

			/*Slug*/
			$data['slug'] = $post->post_name;

			/*Status*/
			$data['status'] = $post->post_status;

			/*Post type*/
			$data['type'] = $post->post_type;

			/*Permalink*/
			$data['link'] = get_permalink( $post->ID );

			/*title*/
			$data['title']        = array();
			$data['title']['raw'] = $post->post_title;

			add_filter( 'protected_title_format', array( $this, 'protected_title_format' ) );
			$data['title']['rendered'] = get_the_title( $post->ID );
			remove_filter( 'protected_title_format', array( $this, 'protected_title_format' ) );

			/*Content*/
			$data['content']                  = array();
			$data['content']['raw']           = $post->post_content;
			$data['content']['rendered']      = post_password_required( $post ) ? '' : apply_filters( 'the_content', $post->post_content );
			$data['content']['protected']     = (bool) $post->post_password;
			$data['content']['block_version'] = block_version( $post->post_content );

			/*Excerpt*/
            $excerpt         = gutentor_get_excerpt_by_id($post->ID,1000);
			$data['excerpt'] = array(
				'raw'       => $post->post_excerpt,
				'rendered'  => post_password_required( $post ) ? '' : $excerpt,
				'protected' => (bool) $post->post_password,
			);

			/*Author*/
			$data['author'] = (int) $post->post_author;

			/*Feature Media*/
			$data['featured_media'] = (int) get_post_thumbnail_id( $post->ID );

			/*Parent*/
			$data['parent'] = (int) $post->post_parent;

			/*Menu Order*/
			$data['menu_order'] = (int) $post->menu_order;

			/*Comment Status*/
			$data['comment_status'] = $post->comment_status;

			/*Ping Status*/
			$data['ping_status'] = $post->ping_status;

			/*Is sticky*/
			$data['sticky'] = is_sticky( $post->ID );

			/*Tempalate*/
			$template = get_page_template_slug( $post->ID );
			if ( $template ) {
				$data['template'] = $template;
			} else {
				$data['template'] = '';
			}

			/*Post format*/
			$data['format'] = get_post_format( $post->ID );

			// Fill in blank post format.
			if ( empty( $data['format'] ) ) {
				$data['format'] = 'standard';
			}

			/*Taxonomies*/
			$post_type  = $request->get_param( 'post_type' ) ? $request->get_param( 'post_type' ) : 'post';
			$taxonomies = wp_list_filter( get_object_taxonomies( $post_type, 'objects' ) );
			foreach ( $taxonomies as $taxonomy ) {
				$base  = ! empty( $taxonomy->rest_base ) ? $taxonomy->rest_base : $taxonomy->name;
				$terms = get_the_terms( $post, $taxonomy->name );
				if ( $terms && ! is_wp_error( $terms ) ) :
					foreach ( $terms as $term_key => $term_value ) {
						$term_value->link = esc_url_raw( get_term_link( $term_value->slug, $taxonomy->name ) );
					}
				endif;
				$data[ $base ] = $terms ? $terms : array();
			}
			/*Permalink template*/
			$post_type_obj = get_post_type_object( $post->post_type );
			if ( is_post_type_viewable( $post_type_obj ) && $post_type_obj->public ) {
				if ( ! function_exists( 'get_sample_permalink' ) ) {
					require_once ABSPATH . 'wp-admin/includes/post.php';
				}

				$sample_permalink = get_sample_permalink( $post->ID, $post->post_title, '' );

				$data['permalink_template'] = $sample_permalink[0];
				$data['generated_slug']     = $sample_permalink[1];
			}

			$context = ! empty( $request['context'] ) ? $request['context'] : 'view';
			$data    = $this->add_additional_fields_to_object( $data, $request );
			$data    = $this->filter_response_by_context( $data, $context );
			$data    = apply_filters( "gutentor_rest_prepare_data_{$post_type}", $data, $post, $request );
			// Wrap the data in a response object.
			$response = rest_ensure_response( $data );
			$links    = $this->prepare_links( $post );
			$response->add_links( $links );

			/**
			 * Filters the post data for a response.
			 *
			 * The dynamic portion of the hook name, `$post->post_type`, refers to the post type slug.
			 *
			 * @since 4.7.0
			 *
			 * @param WP_REST_Response $response The response object.
			 * @param WP_Post          $post     Post object.
			 * @param WP_REST_Request  $request  Request object.
			 */
			return apply_filters( "gutentor_rest_prepare_{$post_type}", $response, $post, $request );
		}

		/**
		 * Function to fetch posts.
		 * Copied from WP_REST_Posts_Controller get_items and modified
		 *
		 * @since 2.1.3
		 * @param WP_REST_Request $request Full details about the request.
		 * @return WP_REST_Response|WP_Error Response object on success, or WP_Error object on failure.
		 */
		public function get_posts( \WP_REST_Request $request ) {
			
			$query_args = array(
				'posts_per_page'      => $request->get_param( 'per_page' ) ? $request->get_param( 'per_page' ) : 6,
				'post_type'           => $request->get_param( 'post_type' ) ? $request->get_param( 'post_type' ) : 'post',
				'orderby'             => $request->get_param( 'orderby' ) ? $request->get_param( 'orderby' ) : 'date',
				'order'               => $request->get_param( 'order' ) ? $request->get_param( 'order' ) : 'desc',
				'paged'               => $request->get_param( 'paged' ) ? $request->get_param( 'paged' ) : 1,
				'ignore_sticky_posts' => true,
				'post_status'         => 'publish',
			);
			if ( $request->get_param( 'taxonomy' ) &&
				$request->get_param( 'term' ) ) {
				$query_args['tax_query'] = array(
					array(
						'taxonomy' => $request->get_param( 'taxonomy' ),
						'field'    => 'id',
						'terms'    => explode( ',', $request->get_param( 'term' ) ),
					),
				);
			}

			if ( $request->get_param( 'offset' ) && ! ( $query_args > 1 ) ) {
				$query_args['offset'] = $request->get_param( 'offset' ) ? $request->get_param( 'offset' ) : 0;
			}
			if ( $request->get_param( 'post__in' ) ) {
				$query_args['post__in'] = explode( ',', $request->get_param( 'post__in' ) );
			}
			if ( $request->get_param( 'post__not_in' ) ) {
				$query_args['post__not_in'] = explode( ',', $request->get_param( 'post__not_in' ) );
			}

			$posts_query  = new WP_Query();
			$query_result = $posts_query->query( $query_args );

			$posts = array();

			foreach ( $query_result as $post ) {

				$data    = $this->prepare_item_for_response( $post, $request );
				$posts[] = $this->prepare_response_for_collection( $data );
			}

			$page        = (int) $query_args['paged'];
			$total_posts = $posts_query->found_posts;

			if ( $total_posts < 1 ) {
				// Out-of-bounds, run the query again without LIMIT for total count.
				unset( $query_args['paged'] );

				$count_query = new WP_Query();
				$count_query->query( $query_args );
				$total_posts = $count_query->found_posts;
			}

			$max_pages = ceil( $total_posts / (int) $posts_query->query_vars['posts_per_page'] );

			if ( $page > $max_pages && $total_posts > 0 ) {
				return new WP_Error(
					'rest_post_invalid_page_number',
					__( 'The page number requested is larger than the number of pages available.' ),
					array( 'status' => 400 )
				);
			}

			$response = rest_ensure_response( $posts );

			$response->header( 'X-WP-Total', (int) $total_posts );
			$response->header( 'X-WP-TotalPages', (int) $max_pages );

			$request_params = $request->get_query_params();
			$base           = add_query_arg( urlencode_deep( $request_params ), rest_url( sprintf( '%s/%s', $this->namespace, $this->rest_base ) ) );

			if ( $page > 1 ) {
				$prev_page = $page - 1;

				if ( $prev_page > $max_pages ) {
					$prev_page = $max_pages;
				}

				$prev_link = add_query_arg( 'page', $prev_page, $base );
				$response->link_header( 'prev', $prev_link );
			}
			if ( $max_pages > $page ) {
				$next_page = $page + 1;
				$next_link = add_query_arg( 'page', $next_page, $base );

				$response->link_header( 'next', $next_link );
			}

			return $response;
		}


		/**
		 * Gets an instance of this object.
		 * Prevents duplicate instances which avoid artefacts and improves performance.
		 *
		 * @static
		 * @access public
		 * @since 1.0.1
		 * @return object
		 */
		public static function get_instance() {
			// Store the instance locally to avoid private static replication
			static $instance = null;

			// Only run these methods if they haven't been ran previously
			if ( null === $instance ) {
				$instance = new self();
			}

			// Always return the instance
			return $instance;
		}

		/**
		 * Throw error on object clone
		 *
		 * The whole idea of the singleton design pattern is that there is a single
		 * object therefore, we don't want the object to be cloned.
		 *
		 * @access public
		 * @since 1.0.0
		 * @return void
		 */
		public function __clone() {
			// Cloning instances of the class is forbidden.
			_doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'gutentor' ), '1.0.0' );
		}

		/**
		 * Disable unserializing of the class
		 *
		 * @access public
		 * @since 1.0.0
		 * @return void
		 */
		public function __wakeup() {
			// Unserializing instances of the class is forbidden.
			_doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'gutentor' ), '1.0.0' );
		}
	}

}
Gutentor_Self_Api_Handler::get_instance()->run();
