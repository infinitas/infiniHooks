<?php
define('RUNNING_TESTS', true);
require __DIR__ . '/cakephp1.3-tests.php';

class Cakephp13HookTest extends PHPUnit_Framework_TestCase {

	function testNonPhpFiles() {

		$result = testCase('.gitignore');
		$this->assertFalse($result);

		$result = testCase('empty');
		$this->assertFalse($result);

		$result = testCase('some.sh');
		$this->assertFalse($result);

		$result = testCase('textfile.txt');
		$this->assertFalse($result);

	}

	function testAppFiles() {

		$result = testCase('controllers/tests_apps_posts_controller.php');
		$this->assertEquals('app', $result['category']);
		$this->assertEquals('controllers/tests_apps_posts_controller', $result['case']);
		$this->assertEquals('tests/cases/controllers/tests_apps_posts_controller.test.php', $result['testFile']);

		$result = testCase('controllers/tests_apps_controller.php');
		$this->assertEquals('app', $result['category']);
		$this->assertEquals('controllers/tests_apps_controller', $result['case']);
		$this->assertEquals('tests/cases/controllers/tests_apps_controller.test.php', $result['testFile']);

		$result = testCase('models/behaviors/persister_one_behavior.php');
		$this->assertEquals('app', $result['category']);
		$this->assertEquals('behaviors/persister_one_behavior', $result['case']);
		$this->assertEquals('tests/cases/models/behaviors/persister_one_behavior.test.php', $result['testFile']);

		$result = testCase('models/behaviors/persister_two_behavior.php');
		$this->assertEquals('app', $result['category']);
		$this->assertEquals('behaviors/persister_two_behavior', $result['case']);
		$this->assertEquals('tests/cases/models/behaviors/persister_two_behavior.test.php', $result['testFile']);

		$result = testCase('models/datasources/test/test_local_driver.php');
		$this->assertEquals('app', $result['category']);
		$this->assertEquals('datasources/test/test_local_driver', $result['case']);
		$this->assertEquals('tests/cases/models/datasources/test/test_local_driver.test.php', $result['testFile']);

		$result = testCase('models/datasources/test2_other_source.php');
		$this->assertEquals('app', $result['category']);
		$this->assertEquals('datasources/test2_other_source', $result['case']);
		$this->assertEquals('tests/cases/models/datasources/test2_other_source.test.php', $result['testFile']);

		$result = testCase('models/datasources/test2_source.php');
		$this->assertEquals('app', $result['category']);
		$this->assertEquals('datasources/test2_source', $result['case']);
		$this->assertEquals('tests/cases/models/datasources/test2_source.test.php', $result['testFile']);

		$result = testCase('models/persister_two.php');
		$this->assertEquals('app', $result['category']);
		$this->assertEquals('models/persister_two', $result['case']);
		$this->assertEquals('tests/cases/models/persister_two.test.php', $result['testFile']);

		$result = testCase('models/comment.php');
		$this->assertEquals('app', $result['category']);
		$this->assertEquals('models/comment', $result['case']);
		$this->assertEquals('tests/cases/models/comment.test.php', $result['testFile']);

		$result = testCase('models/post.php');
		$this->assertEquals('app', $result['category']);
		$this->assertEquals('models/post', $result['case']);
		$this->assertEquals('tests/cases/models/post.test.php', $result['testFile']);

		$result = testCase('models/persister_one.php');
		$this->assertEquals('app', $result['category']);
		$this->assertEquals('models/persister_one', $result['case']);
		$this->assertEquals('tests/cases/models/persister_one.test.php', $result['testFile']);

		$result = testCase('views/helpers/banana.php');
		$this->assertEquals('app', $result['category']);
		$this->assertEquals('helpers/banana', $result['case']);
		$this->assertEquals('tests/cases/views/helpers/banana.test.php', $result['testFile']);

		$result = testCase('vendors/shells/sample.php');
		$this->assertEquals('app', $result['category']);
		$this->assertEquals('shells/sample', $result['case']);
		$this->assertEquals('tests/cases/vendors/shells/sample.test.php', $result['testFile']);

		$result = testCase('libs/cache/test_app_cache.php');
		$this->assertEquals('app', $result['category']);
		$this->assertEquals('libs/cache/test_app_cache', $result['case']);
		$this->assertEquals('tests/cases/libs/cache/test_app_cache.test.php', $result['testFile']);

		$result = testCase('libs/library.php');
		$this->assertEquals('app', $result['category']);
		$this->assertEquals('libs/library', $result['case']);
		$this->assertEquals('tests/cases/libs/library.test.php', $result['testFile']);

		$result = testCase('libs/log/test_app_log.php');
		$this->assertEquals('app', $result['category']);
		$this->assertEquals('libs/log/test_app_log', $result['case']);
		$this->assertEquals('tests/cases/libs/log/test_app_log.test.php', $result['testFile']);
	}

	function testPluginFiles() {

		$result = testCase('plugins/test_plugin_two/vendors/shells/example.php');
		$this->assertEquals('test_plugin_two', $result['category']);
		$this->assertEquals('shells/example', $result['case']);
		$this->assertEquals('plugins/test_plugin_two/tests/cases/vendors/shells/example.test.php', $result['testFile']);

		$result = testCase('plugins/test_plugin_two/vendors/shells/welcome.php');
		$this->assertEquals('test_plugin_two', $result['category']);
		$this->assertEquals('shells/welcome', $result['case']);
		$this->assertEquals('plugins/test_plugin_two/tests/cases/vendors/shells/welcome.test.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/test_plugin_app_controller.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('plugins/test_plugin/test_plugin_app_controller', $result['case']);
		$this->assertEquals('tests/cases/plugins/test_plugin/test_plugin_app_controller.test.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/controllers/test_plugin_controller.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('controllers/test_plugin_controller', $result['case']);
		$this->assertEquals('plugins/test_plugin/tests/cases/controllers/test_plugin_controller.test.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/controllers/components/test_plugin_other_component.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('components/test_plugin_other_component', $result['case']);
		$this->assertEquals('plugins/test_plugin/tests/cases/controllers/components/test_plugin_other_component.test.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/controllers/components/other_component.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('components/other_component', $result['case']);
		$this->assertEquals('plugins/test_plugin/tests/cases/controllers/components/other_component.test.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/controllers/components/plugins_component.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('components/plugins_component', $result['case']);
		$this->assertEquals('plugins/test_plugin/tests/cases/controllers/components/plugins_component.test.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/controllers/components/test_plugin_component.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('components/test_plugin_component', $result['case']);
		$this->assertEquals('plugins/test_plugin/tests/cases/controllers/components/test_plugin_component.test.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/controllers/tests_controller.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('controllers/tests_controller', $result['case']);
		$this->assertEquals('plugins/test_plugin/tests/cases/controllers/tests_controller.test.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/test_plugin_app_model.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('plugins/test_plugin/test_plugin_app_model', $result['case']);
		$this->assertEquals('tests/cases/plugins/test_plugin/test_plugin_app_model.test.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/models/test_plugin_post.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('models/test_plugin_post', $result['case']);
		$this->assertEquals('plugins/test_plugin/tests/cases/models/test_plugin_post.test.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/models/test_plugin_auth_user.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('models/test_plugin_auth_user', $result['case']);
		$this->assertEquals('plugins/test_plugin/tests/cases/models/test_plugin_auth_user.test.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/models/behaviors/test_plugin_persister_one.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('behaviors/test_plugin_persister_one', $result['case']);
		$this->assertEquals('plugins/test_plugin/tests/cases/models/behaviors/test_plugin_persister_one.test.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/models/behaviors/test_plugin_persister_two.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('behaviors/test_plugin_persister_two', $result['case']);
		$this->assertEquals('plugins/test_plugin/tests/cases/models/behaviors/test_plugin_persister_two.test.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/models/test_plugin_authors.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('models/test_plugin_authors', $result['case']);
		$this->assertEquals('plugins/test_plugin/tests/cases/models/test_plugin_authors.test.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/models/datasources/test/test_driver.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('datasources/test/test_driver', $result['case']);
		$this->assertEquals('plugins/test_plugin/tests/cases/models/datasources/test/test_driver.test.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/models/datasources/dbo/dbo_dummy.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('datasources/dbo/dbo_dummy', $result['case']);
		$this->assertEquals('plugins/test_plugin/tests/cases/models/datasources/dbo/dbo_dummy.test.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/models/datasources/test_source.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('datasources/test_source', $result['case']);
		$this->assertEquals('plugins/test_plugin/tests/cases/models/datasources/test_source.test.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/models/datasources/test_other_source.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('datasources/test_other_source', $result['case']);
		$this->assertEquals('plugins/test_plugin/tests/cases/models/datasources/test_other_source.test.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/models/test_plugin_comment.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('models/test_plugin_comment', $result['case']);
		$this->assertEquals('plugins/test_plugin/tests/cases/models/test_plugin_comment.test.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/views/helpers/other_helper.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('helpers/other_helper', $result['case']);
		$this->assertEquals('plugins/test_plugin/tests/cases/views/helpers/other_helper.test.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/views/helpers/test_plugin_app.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('app', $result['case']);
		$this->assertEquals('plugins/test_plugin/views/helpers/test_plugin_tests/cases/app.test.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/views/helpers/plugged_helper.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('helpers/plugged_helper', $result['case']);
		$this->assertEquals('plugins/test_plugin/tests/cases/views/helpers/plugged_helper.test.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/vendors/shells/example.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('shells/example', $result['case']);
		$this->assertEquals('plugins/test_plugin/tests/cases/vendors/shells/example.test.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/libs/test_plugin_library.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('libs/test_plugin_library', $result['case']);
		$this->assertEquals('plugins/test_plugin/tests/cases/libs/test_plugin_library.test.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/libs/cache/test_plugin_cache.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('libs/cache/test_plugin_cache', $result['case']);
		$this->assertEquals('plugins/test_plugin/tests/cases/libs/cache/test_plugin_cache.test.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/libs/log/test_plugin_log.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('libs/log/test_plugin_log', $result['case']);
		$this->assertEquals('plugins/test_plugin/tests/cases/libs/log/test_plugin_log.test.php', $result['testFile']);

	}

	function testCoreFiles() {

		$result = testCase('index.php');
		$this->assertEquals('app', $result['category']);
		$this->assertEquals('index', $result['case']);
		$this->assertEquals('index', $result['testFile']);

		$result = testCase('app/index.php');
		$this->assertEquals('app', $result['category']);
		$this->assertEquals('app/index', $result['case']);
		$this->assertEquals('app/index', $result['testFile']);

		$result = testCase('app/webroot/css.php');
		$this->assertEquals('app', $result['category']);
		$this->assertEquals('app/webroot/css', $result['case']);
		$this->assertEquals('app/webroot/css', $result['testFile']);

		$result = testCase('app/webroot/test.php');
		$this->assertEquals('app', $result['category']);
		$this->assertEquals('app/webroot/test', $result['case']);
		$this->assertEquals('app/webroot/test', $result['testFile']);

		$result = testCase('app/webroot/index.php');
		$this->assertEquals('app', $result['category']);
		$this->assertEquals('app/webroot/index', $result['case']);
		$this->assertEquals('app/webroot/index', $result['testFile']);

		$result = testCase('cake/bootstrap.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('bootstrap', $result['case']);
		$this->assertEquals('cake/tests/cases/bootstrap.test.php', $result['testFile']);

		$result = testCase('cake/basics.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('basics', $result['case']);
		$this->assertEquals('cake/tests/cases/basics.test.php', $result['testFile']);

		$result = testCase('cake/tests/fixtures/translate_article_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/auth_user_custom_field_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/category_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/featured_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/uuiditem_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/counter_cache_user_nonstandard_primary_key_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/book_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/join_c_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/aro_two_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/document_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/item_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/product_update_all_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/numeric_article_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/cd_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/another_article_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/aco_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/film_file_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/underscore_field_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/join_b_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/article_featured_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/ad_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/aros_aco_two_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/primary_model_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/my_user_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/translate_with_prefix_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/dependency_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/posts_tag_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/document_directory_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/image_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/thread_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/test_plugin_article_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/something_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/translate_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/device_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/article_featureds_tags_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/binary_test_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/my_product_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/post_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/uuid_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/article_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/secondary_model_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/number_tree_two_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/uuidportfolio_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/translated_article_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/join_a_c_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/fruit_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/stories_tag_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/join_thing_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/auth_user_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/my_categories_my_products_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/my_category_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/advertisement_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/callback_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/data_test_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/overall_favorite_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/attachment_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/counter_cache_post_nonstandard_primary_key_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/group_update_all_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/counter_cache_user_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/syfile_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/content_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/number_tree_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/aro_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/counter_cache_post_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/translate_table_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/category_thread_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/campaign_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/aco_action_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/device_type_category_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/the_paper_monkies_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/test_plugin_comment_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/basket_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/uuid_tag_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/project_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/bid_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/unconventional_tree_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/person_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/sample_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/product_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/home_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/account_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/something_else_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/content_account_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/cache_test_model_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/uuid_tree_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/story_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/apple_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/feature_set_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/join_a_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/uuiditems_uuidportfolio_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/datatype_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/uuiditems_uuidportfolio_numericid_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/portfolio_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/join_a_b_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/node_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/articles_tag_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/after_tree_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/aros_aco_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/aco_two_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/author_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/message_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/device_type_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/my_categories_my_users_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/translated_item_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/tag_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/flag_tree_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/session_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/items_portfolio_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/fruits_uuid_tag_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/exterior_type_category_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/comment_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/fixtures/user_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/cases/basics.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('basics', $result['case']);
		$this->assertEquals('cake/tests/cases/basics.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/dispatcher.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('dispatcher', $result['case']);
		$this->assertEquals('cake/tests/cases/dispatcher.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/console/cake.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('console/cake', $result['case']);
		$this->assertEquals('cake/tests/cases/console/cake.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/console/libs/acl.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('console/libs/acl', $result['case']);
		$this->assertEquals('cake/tests/cases/console/libs/acl.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/console/libs/shell.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('console/libs/shell', $result['case']);
		$this->assertEquals('cake/tests/cases/console/libs/shell.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/console/libs/tasks/project.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('console/libs/tasks/project', $result['case']);
		$this->assertEquals('cake/tests/cases/console/libs/tasks/project.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/console/libs/tasks/db_config.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('console/libs/tasks/db_config', $result['case']);
		$this->assertEquals('cake/tests/cases/console/libs/tasks/db_config.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/console/libs/tasks/view.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('console/libs/tasks/view', $result['case']);
		$this->assertEquals('cake/tests/cases/console/libs/tasks/view.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/console/libs/tasks/test.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('console/libs/tasks/test', $result['case']);
		$this->assertEquals('cake/tests/cases/console/libs/tasks/test.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/console/libs/tasks/extract.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('console/libs/tasks/extract', $result['case']);
		$this->assertEquals('cake/tests/cases/console/libs/tasks/extract.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/console/libs/tasks/model.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('console/libs/tasks/model', $result['case']);
		$this->assertEquals('cake/tests/cases/console/libs/tasks/model.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/console/libs/tasks/plugin.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('console/libs/tasks/plugin', $result['case']);
		$this->assertEquals('cake/tests/cases/console/libs/tasks/plugin.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/console/libs/tasks/controller.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('console/libs/tasks/controller', $result['case']);
		$this->assertEquals('cake/tests/cases/console/libs/tasks/controller.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/console/libs/tasks/template.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('console/libs/tasks/template', $result['case']);
		$this->assertEquals('cake/tests/cases/console/libs/tasks/template.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/console/libs/tasks/fixture.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('console/libs/tasks/fixture', $result['case']);
		$this->assertEquals('cake/tests/cases/console/libs/tasks/fixture.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/console/libs/bake.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('console/libs/bake', $result['case']);
		$this->assertEquals('cake/tests/cases/console/libs/bake.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/console/libs/schema.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('console/libs/schema', $result['case']);
		$this->assertEquals('cake/tests/cases/console/libs/schema.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/console/libs/api.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('console/libs/api', $result['case']);
		$this->assertEquals('cake/tests/cases/console/libs/api.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/cake_session.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/cake_session', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/cake_session.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/file.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/file', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/file.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/sanitize.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/sanitize', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/sanitize.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/code_coverage_manager.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/code_coverage_manager', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/code_coverage_manager.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/cake_test_case.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/cake_test_case', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/cake_test_case.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/cake_socket.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/cake_socket', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/cake_socket.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/test_manager.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/test_manager', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/test_manager.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/i18n.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/i18n', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/i18n.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/configure.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/configure', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/configure.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/overloadable.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/overloadable', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/overloadable.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/http_socket.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/http_socket', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/http_socket.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/cake_test_fixture.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/cake_test_fixture', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/cake_test_fixture.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/cache/file.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/cache/file', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/cache/file.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/cache/xcache.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/cache/xcache', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/cache/xcache.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/cache/memcache.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/cache/memcache', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/cache/memcache.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/cache/apc.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/cache/apc', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/cache/apc.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/inflector.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/inflector', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/inflector.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/model/db_acl.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/model/db_acl', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/model/db_acl.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/model/model_integration.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/model/model_integration', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/model/model_integration.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/model/connection_manager.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/model/connection_manager', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/model/connection_manager.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/model/behaviors/acl.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/model/behaviors/acl', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/model/behaviors/acl.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/model/behaviors/tree.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/model/behaviors/tree', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/model/behaviors/tree.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/model/behaviors/containable.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/model/behaviors/containable', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/model/behaviors/containable.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/model/behaviors/translate.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/model/behaviors/translate', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/model/behaviors/translate.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/model/models.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/cases/libs/model/model_validation.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/model/model_validation', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/model/model_validation.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/model/datasources/dbo/dbo_sqlite.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/model/datasources/dbo/dbo_sqlite', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/model/datasources/dbo/dbo_sqlite.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/model/datasources/dbo/dbo_mysqli.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/model/datasources/dbo/dbo_mysqli', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/model/datasources/dbo/dbo_mysqli.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/model/datasources/dbo/dbo_mssql.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/model/datasources/dbo/dbo_mssql', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/model/datasources/dbo/dbo_mssql.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/model/datasources/dbo/dbo_oracle.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/model/datasources/dbo/dbo_oracle', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/model/datasources/dbo/dbo_oracle.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/model/datasources/dbo/dbo_mysql.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/model/datasources/dbo/dbo_mysql', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/model/datasources/dbo/dbo_mysql.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/model/datasources/dbo/dbo_postgres.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/model/datasources/dbo/dbo_postgres', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/model/datasources/dbo/dbo_postgres.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/model/datasources/dbo_source.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/model/datasources/dbo_source', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/model/datasources/dbo_source.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/model/model.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/model/model', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/model/model.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/model/cake_schema.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/model/cake_schema', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/model/cake_schema.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/model/model_delete.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/model/model_delete', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/model/model_delete.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/model/model_write.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/model/model_write', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/model/model_write.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/model/model_behavior.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/model/model_behavior', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/model/model_behavior.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/model/model_read.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/model/model_read', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/model/model_read.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/object.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/object', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/object.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/error.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/error', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/error.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/magic_db.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/magic_db', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/magic_db.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/view/view.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/view/view', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/view/view.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/view/media.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/view/media', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/view/media.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/view/theme.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/view/theme', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/view/theme.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/view/helper.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/view/helper', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/view/helper.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/view/helpers/form.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/view/helpers/form', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/view/helpers/form.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/view/helpers/js.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/view/helpers/js', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/view/helpers/js.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/view/helpers/html.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/view/helpers/html', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/view/helpers/html.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/view/helpers/text.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/view/helpers/text', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/view/helpers/text.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/view/helpers/number.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/view/helpers/number', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/view/helpers/number.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/view/helpers/time.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/view/helpers/time', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/view/helpers/time.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/view/helpers/jquery_engine.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/view/helpers/jquery_engine', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/view/helpers/jquery_engine.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/view/helpers/rss.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/view/helpers/rss', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/view/helpers/rss.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/view/helpers/prototype_engine.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/view/helpers/prototype_engine', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/view/helpers/prototype_engine.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/view/helpers/paginator.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/view/helpers/paginator', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/view/helpers/paginator.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/view/helpers/ajax.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/view/helpers/ajax', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/view/helpers/ajax.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/view/helpers/javascript.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/view/helpers/javascript', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/view/helpers/javascript.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/view/helpers/cache.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/view/helpers/cache', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/view/helpers/cache.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/view/helpers/session.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/view/helpers/session', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/view/helpers/session.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/view/helpers/mootools_engine.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/view/helpers/mootools_engine', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/view/helpers/mootools_engine.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/view/helpers/xml.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/view/helpers/xml', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/view/helpers/xml.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/set.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/set', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/set.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/class_registry.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/class_registry', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/class_registry.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/cache.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/cache', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/cache.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/cake_log.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/cake_log', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/cake_log.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/validation.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/validation', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/validation.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/security.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/security', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/security.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/l10n.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/l10n', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/l10n.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/multibyte.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/multibyte', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/multibyte.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/string.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/string', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/string.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/debugger.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/debugger', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/debugger.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/router.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/router', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/router.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/folder.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/folder', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/folder.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/log/file_log.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/log/file_log', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/log/file_log.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/xml.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/xml', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/xml.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/controller/controller_merge_vars.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/controller/controller_merge_vars', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/controller/controller_merge_vars.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/controller/pages_controller.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/controller/pages_controller', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/controller/pages_controller.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/controller/component.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/controller/component', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/controller/component.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/controller/components/request_handler.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/controller/components/request_handler', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/controller/components/request_handler.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/controller/components/acl.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/controller/components/acl', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/controller/components/acl.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/controller/components/email.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/controller/components/email', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/controller/components/email.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/controller/components/cookie.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/controller/components/cookie', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/controller/components/cookie.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/controller/components/session.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/controller/components/session', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/controller/components/session.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/controller/components/auth.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/controller/components/auth', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/controller/components/auth.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/controller/components/security.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/controller/components/security', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/controller/components/security.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/controller/controller.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/controller/controller', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/controller/controller.test.php', $result['testFile']);

		$result = testCase('cake/tests/cases/libs/controller/scaffold.test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/controller/scaffold', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/controller/scaffold.test.php', $result['testFile']);

		$result = testCase('cake/tests/groups/i18n.group.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/groups/acl.group.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/groups/socket.group.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/groups/javascript.group.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/groups/behaviors.group.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/groups/test_suite.group.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/groups/database.group.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/groups/cache.group.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/groups/model.group.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/groups/console.group.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/groups/lib.group.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/groups/no_cross_contamination.group.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/groups/controller.group.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/groups/helpers.group.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/groups/configure.group.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/groups/routing_system.group.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/groups/components.group.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/groups/bake.group.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/groups/view.group.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/groups/xml.group.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/lib/test_manager.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/lib/reporter/cake_cli_reporter.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/lib/reporter/cake_text_reporter.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/lib/reporter/cake_base_reporter.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/lib/reporter/cake_html_reporter.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/lib/code_coverage_manager.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/lib/cake_test_fixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/lib/cake_web_test_case.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/lib/cake_test_model.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/lib/templates/simpletest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('cake/tests/templates/simpletest', $result['case']);
		$this->assertEquals('cake/tests/lib/templates/simpletest.php', $result['testFile']);

		$result = testCase('cake/tests/lib/templates/menu.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/lib/templates/footer.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/lib/templates/xdebug.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/lib/templates/header.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/lib/cake_test_suite_dispatcher.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/tests/lib/cake_test_case.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('cake/dispatcher.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('dispatcher', $result['case']);
		$this->assertEquals('cake/tests/cases/dispatcher.test.php', $result['testFile']);

		$result = testCase('cake/console/templates/skel/controllers/pages_controller.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('console/templates/skel/controllers/pages_controller', $result['case']);
		$this->assertEquals('cake/tests/cases/console/templates/skel/controllers/pages_controller.test.php', $result['testFile']);

		$result = testCase('cake/console/templates/skel/app_model.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('console/templates/skel/app_model', $result['case']);
		$this->assertEquals('cake/tests/cases/console/templates/skel/app_model.test.php', $result['testFile']);

		$result = testCase('cake/console/templates/skel/index.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('console/templates/skel/index', $result['case']);
		$this->assertEquals('cake/tests/cases/console/templates/skel/index.test.php', $result['testFile']);

		$result = testCase('cake/console/templates/skel/app_helper.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('console/templates/skel/app_helper', $result['case']);
		$this->assertEquals('cake/tests/cases/console/templates/skel/app_helper.test.php', $result['testFile']);

		$result = testCase('cake/console/templates/skel/app_controller.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('console/templates/skel/app_controller', $result['case']);
		$this->assertEquals('cake/tests/cases/console/templates/skel/app_controller.test.php', $result['testFile']);

		$result = testCase('cake/console/templates/skel/webroot/css.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('console/templates/skel/webroot/css', $result['case']);
		$this->assertEquals('cake/tests/cases/console/templates/skel/webroot/css.test.php', $result['testFile']);

		$result = testCase('cake/console/templates/skel/webroot/test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('console/templates/skel/webroot/test', $result['case']);
		$this->assertEquals('cake/tests/cases/console/templates/skel/webroot/test.test.php', $result['testFile']);

		$result = testCase('cake/console/templates/skel/webroot/index.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('console/templates/skel/webroot/index', $result['case']);
		$this->assertEquals('cake/tests/cases/console/templates/skel/webroot/index.test.php', $result['testFile']);

		$result = testCase('cake/console/cake.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('', $result['case']);
		$this->assertEquals('cake/tests/cases/console/cake.test.php', $result['testFile']);

		$result = testCase('cake/console/error.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('console/error', $result['case']);
		$this->assertEquals('cake/tests/cases/console/error.test.php', $result['testFile']);

		$result = testCase('cake/console/libs/i18n.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('console/libs/i18n', $result['case']);
		$this->assertEquals('cake/tests/cases/console/libs/i18n.test.php', $result['testFile']);

		$result = testCase('cake/console/libs/api.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('console/libs/api', $result['case']);
		$this->assertEquals('cake/tests/cases/console/libs/api.test.php', $result['testFile']);

		$result = testCase('cake/console/libs/console.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('console/libs/console', $result['case']);
		$this->assertEquals('cake/tests/cases/console/libs/console.test.php', $result['testFile']);

		$result = testCase('cake/console/libs/bake.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('console/libs/bake', $result['case']);
		$this->assertEquals('cake/tests/cases/console/libs/bake.test.php', $result['testFile']);

		$result = testCase('cake/console/libs/acl.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('console/libs/acl', $result['case']);
		$this->assertEquals('cake/tests/cases/console/libs/acl.test.php', $result['testFile']);

		$result = testCase('cake/console/libs/testsuite.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('console/libs/testsuite', $result['case']);
		$this->assertEquals('cake/tests/cases/console/libs/testsuite.test.php', $result['testFile']);

		$result = testCase('cake/console/libs/tasks/model.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('console/libs/tasks/model', $result['case']);
		$this->assertEquals('cake/tests/cases/console/libs/tasks/model.test.php', $result['testFile']);

		$result = testCase('cake/console/libs/tasks/controller.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('console/libs/tasks/controller', $result['case']);
		$this->assertEquals('cake/tests/cases/console/libs/tasks/controller.test.php', $result['testFile']);

		$result = testCase('cake/console/libs/tasks/bake.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('console/libs/tasks/bake', $result['case']);
		$this->assertEquals('cake/tests/cases/console/libs/tasks/bake.test.php', $result['testFile']);

		$result = testCase('cake/console/libs/tasks/plugin.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('console/libs/tasks/plugin', $result['case']);
		$this->assertEquals('cake/tests/cases/console/libs/tasks/plugin.test.php', $result['testFile']);

		$result = testCase('cake/console/libs/tasks/project.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('console/libs/tasks/project', $result['case']);
		$this->assertEquals('cake/tests/cases/console/libs/tasks/project.test.php', $result['testFile']);

		$result = testCase('cake/console/libs/tasks/test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('console/libs/tasks/test', $result['case']);
		$this->assertEquals('cake/tests/cases/console/libs/tasks/test.test.php', $result['testFile']);

		$result = testCase('cake/console/libs/tasks/extract.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('console/libs/tasks/extract', $result['case']);
		$this->assertEquals('cake/tests/cases/console/libs/tasks/extract.test.php', $result['testFile']);

		$result = testCase('cake/console/libs/tasks/db_config.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('console/libs/tasks/db_config', $result['case']);
		$this->assertEquals('cake/tests/cases/console/libs/tasks/db_config.test.php', $result['testFile']);

		$result = testCase('cake/console/libs/tasks/fixture.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('console/libs/tasks/fixture', $result['case']);
		$this->assertEquals('cake/tests/cases/console/libs/tasks/fixture.test.php', $result['testFile']);

		$result = testCase('cake/console/libs/tasks/view.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('console/libs/tasks/view', $result['case']);
		$this->assertEquals('cake/tests/cases/console/libs/tasks/view.test.php', $result['testFile']);

		$result = testCase('cake/console/libs/tasks/template.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('console/libs/tasks/template', $result['case']);
		$this->assertEquals('cake/tests/cases/console/libs/tasks/template.test.php', $result['testFile']);

		$result = testCase('cake/console/libs/schema.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('console/libs/schema', $result['case']);
		$this->assertEquals('cake/tests/cases/console/libs/schema.test.php', $result['testFile']);

		$result = testCase('cake/console/libs/shell.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('console/libs/shell', $result['case']);
		$this->assertEquals('cake/tests/cases/console/libs/shell.test.php', $result['testFile']);

		$result = testCase('cake/libs/cake_log.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('_log', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/cake_log.test.php', $result['testFile']);

		$result = testCase('cake/libs/class_registry.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/class_registry', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/class_registry.test.php', $result['testFile']);

		$result = testCase('cake/libs/configure.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/configure', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/configure.test.php', $result['testFile']);

		$result = testCase('cake/libs/i18n.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/i18n', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/i18n.test.php', $result['testFile']);

		$result = testCase('cake/libs/cake_session.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('_session', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/cake_session.test.php', $result['testFile']);

		$result = testCase('cake/libs/string.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/string', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/string.test.php', $result['testFile']);

		$result = testCase('cake/libs/sanitize.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/sanitize', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/sanitize.test.php', $result['testFile']);

		$result = testCase('cake/libs/validation.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/validation', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/validation.test.php', $result['testFile']);

		$result = testCase('cake/libs/inflector.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/inflector', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/inflector.test.php', $result['testFile']);

		$result = testCase('cake/libs/cake_socket.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('_socket', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/cake_socket.test.php', $result['testFile']);

		$result = testCase('cake/libs/cache/file.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/cache/file', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/cache/file.test.php', $result['testFile']);

		$result = testCase('cake/libs/cache/apc.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/cache/apc', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/cache/apc.test.php', $result['testFile']);

		$result = testCase('cake/libs/cache/xcache.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/cache/xcache', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/cache/xcache.test.php', $result['testFile']);

		$result = testCase('cake/libs/cache/memcache.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/cache/memcache', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/cache/memcache.test.php', $result['testFile']);

		$result = testCase('cake/libs/model/model.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/model/model', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/model/model.test.php', $result['testFile']);

		$result = testCase('cake/libs/model/behaviors/translate.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/model/behaviors/translate', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/model/behaviors/translate.test.php', $result['testFile']);

		$result = testCase('cake/libs/model/behaviors/tree.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/model/behaviors/tree', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/model/behaviors/tree.test.php', $result['testFile']);

		$result = testCase('cake/libs/model/behaviors/containable.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/model/behaviors/containable', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/model/behaviors/containable.test.php', $result['testFile']);

		$result = testCase('cake/libs/model/behaviors/acl.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/model/behaviors/acl', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/model/behaviors/acl.test.php', $result['testFile']);

		$result = testCase('cake/libs/model/model_behavior.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/model/model_behavior', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/model/model_behavior.test.php', $result['testFile']);

		$result = testCase('cake/libs/model/app_model.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/model/app_model', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/model/app_model.test.php', $result['testFile']);

		$result = testCase('cake/libs/model/datasources/dbo/dbo_postgres.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/model/datasources/dbo/dbo_postgres', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/model/datasources/dbo/dbo_postgres.test.php', $result['testFile']);

		$result = testCase('cake/libs/model/datasources/dbo/dbo_oracle.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/model/datasources/dbo/dbo_oracle', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/model/datasources/dbo/dbo_oracle.test.php', $result['testFile']);

		$result = testCase('cake/libs/model/datasources/dbo/dbo_mysql.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/model/datasources/dbo/dbo_mysql', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/model/datasources/dbo/dbo_mysql.test.php', $result['testFile']);

		$result = testCase('cake/libs/model/datasources/dbo/dbo_mssql.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/model/datasources/dbo/dbo_mssql', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/model/datasources/dbo/dbo_mssql.test.php', $result['testFile']);

		$result = testCase('cake/libs/model/datasources/dbo/dbo_sqlite.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/model/datasources/dbo/dbo_sqlite', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/model/datasources/dbo/dbo_sqlite.test.php', $result['testFile']);

		$result = testCase('cake/libs/model/datasources/dbo/dbo_mysqli.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/model/datasources/dbo/dbo_mysqli', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/model/datasources/dbo/dbo_mysqli.test.php', $result['testFile']);

		$result = testCase('cake/libs/model/datasources/dbo_source.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/model/datasources/dbo_source', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/model/datasources/dbo_source.test.php', $result['testFile']);

		$result = testCase('cake/libs/model/datasources/datasource.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/model/datasources/datasource', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/model/datasources/datasource.test.php', $result['testFile']);

		$result = testCase('cake/libs/model/db_acl.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/model/db_acl', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/model/db_acl.test.php', $result['testFile']);

		$result = testCase('cake/libs/model/cake_schema.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('_schema', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/model/cake_schema.test.php', $result['testFile']);

		$result = testCase('cake/libs/model/connection_manager.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/model/connection_manager', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/model/connection_manager.test.php', $result['testFile']);

		$result = testCase('cake/libs/overloadable_php5.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/overloadable_php5', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/overloadable_php5.test.php', $result['testFile']);

		$result = testCase('cake/libs/router.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/router', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/router.test.php', $result['testFile']);

		$result = testCase('cake/libs/folder.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/folder', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/folder.test.php', $result['testFile']);

		$result = testCase('cake/libs/file.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/file', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/file.test.php', $result['testFile']);

		$result = testCase('cake/libs/xml.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/xml', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/xml.test.php', $result['testFile']);

		$result = testCase('cake/libs/view/helpers/rss.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/view/helpers/rss', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/view/helpers/rss.test.php', $result['testFile']);

		$result = testCase('cake/libs/view/helpers/prototype_engine.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/view/helpers/prototype_engine', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/view/helpers/prototype_engine.test.php', $result['testFile']);

		$result = testCase('cake/libs/view/helpers/paginator.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/view/helpers/paginator', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/view/helpers/paginator.test.php', $result['testFile']);

		$result = testCase('cake/libs/view/helpers/xml.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/view/helpers/xml', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/view/helpers/xml.test.php', $result['testFile']);

		$result = testCase('cake/libs/view/helpers/javascript.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/view/helpers/javascript', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/view/helpers/javascript.test.php', $result['testFile']);

		$result = testCase('cake/libs/view/helpers/jquery_engine.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/view/helpers/jquery_engine', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/view/helpers/jquery_engine.test.php', $result['testFile']);

		$result = testCase('cake/libs/view/helpers/number.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/view/helpers/number', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/view/helpers/number.test.php', $result['testFile']);

		$result = testCase('cake/libs/view/helpers/ajax.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/view/helpers/ajax', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/view/helpers/ajax.test.php', $result['testFile']);

		$result = testCase('cake/libs/view/helpers/time.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/view/helpers/time', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/view/helpers/time.test.php', $result['testFile']);

		$result = testCase('cake/libs/view/helpers/app_helper.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/view/helpers/app_helper', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/view/helpers/app_helper.test.php', $result['testFile']);

		$result = testCase('cake/libs/view/helpers/session.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/view/helpers/session', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/view/helpers/session.test.php', $result['testFile']);

		$result = testCase('cake/libs/view/helpers/text.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/view/helpers/text', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/view/helpers/text.test.php', $result['testFile']);

		$result = testCase('cake/libs/view/helpers/cache.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/view/helpers/cache', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/view/helpers/cache.test.php', $result['testFile']);

		$result = testCase('cake/libs/view/helpers/js.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/view/helpers/js', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/view/helpers/js.test.php', $result['testFile']);

		$result = testCase('cake/libs/view/helpers/form.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/view/helpers/form', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/view/helpers/form.test.php', $result['testFile']);

		$result = testCase('cake/libs/view/helpers/mootools_engine.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/view/helpers/mootools_engine', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/view/helpers/mootools_engine.test.php', $result['testFile']);

		$result = testCase('cake/libs/view/helpers/html.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/view/helpers/html', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/view/helpers/html.test.php', $result['testFile']);

		$result = testCase('cake/libs/view/theme.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/view/theme', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/view/theme.test.php', $result['testFile']);

		$result = testCase('cake/libs/view/media.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/view/media', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/view/media.test.php', $result['testFile']);

		$result = testCase('cake/libs/view/helper.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/view/helper', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/view/helper.test.php', $result['testFile']);

		$result = testCase('cake/libs/view/view.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/view/view', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/view/view.test.php', $result['testFile']);

		$result = testCase('cake/libs/debugger.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/debugger', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/debugger.test.php', $result['testFile']);

		$result = testCase('cake/libs/set.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/set', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/set.test.php', $result['testFile']);

		$result = testCase('cake/libs/multibyte.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/multibyte', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/multibyte.test.php', $result['testFile']);

		$result = testCase('cake/libs/http_socket.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/http_socket', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/http_socket.test.php', $result['testFile']);

		$result = testCase('cake/libs/overloadable.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/overloadable', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/overloadable.test.php', $result['testFile']);

		$result = testCase('cake/libs/overloadable_php4.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/overloadable_php4', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/overloadable_php4.test.php', $result['testFile']);

		$result = testCase('cake/libs/object.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/object', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/object.test.php', $result['testFile']);

		$result = testCase('cake/libs/security.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/security', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/security.test.php', $result['testFile']);

		$result = testCase('cake/libs/cache.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/cache', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/cache.test.php', $result['testFile']);

		$result = testCase('cake/libs/log/file_log.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/log/file_log', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/log/file_log.test.php', $result['testFile']);

		$result = testCase('cake/libs/magic_db.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/magic_db', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/magic_db.test.php', $result['testFile']);

		$result = testCase('cake/libs/error.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/error', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/error.test.php', $result['testFile']);

		$result = testCase('cake/libs/l10n.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/l10n', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/l10n.test.php', $result['testFile']);

		$result = testCase('cake/libs/controller/pages_controller.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/controller/pages_controller', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/controller/pages_controller.test.php', $result['testFile']);

		$result = testCase('cake/libs/controller/controller.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/controller/controller', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/controller/controller.test.php', $result['testFile']);

		$result = testCase('cake/libs/controller/component.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/controller/component', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/controller/component.test.php', $result['testFile']);

		$result = testCase('cake/libs/controller/components/auth.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/controller/components/auth', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/controller/components/auth.test.php', $result['testFile']);

		$result = testCase('cake/libs/controller/components/acl.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/controller/components/acl', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/controller/components/acl.test.php', $result['testFile']);

		$result = testCase('cake/libs/controller/components/cookie.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/controller/components/cookie', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/controller/components/cookie.test.php', $result['testFile']);

		$result = testCase('cake/libs/controller/components/email.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/controller/components/email', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/controller/components/email.test.php', $result['testFile']);

		$result = testCase('cake/libs/controller/components/session.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/controller/components/session', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/controller/components/session.test.php', $result['testFile']);

		$result = testCase('cake/libs/controller/components/request_handler.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/controller/components/request_handler', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/controller/components/request_handler.test.php', $result['testFile']);

		$result = testCase('cake/libs/controller/components/security.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/controller/components/security', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/controller/components/security.test.php', $result['testFile']);

		$result = testCase('cake/libs/controller/app_controller.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/controller/app_controller', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/controller/app_controller.test.php', $result['testFile']);

		$result = testCase('cake/libs/controller/scaffold.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('libs/controller/scaffold', $result['case']);
		$this->assertEquals('cake/tests/cases/libs/controller/scaffold.test.php', $result['testFile']);

	}
}
