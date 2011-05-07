<?php
define('RUNNING_TESTS', true);
require __DIR__ . '/cakephp2.0-tests.php';

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

		$result = testCase('vendors/somename/some.name.php');
		$this->assertEquals('app', $result['category']);
		$this->assertEquals('vendors/somename/some.name', $result['case']);
		$this->assertEquals('tests/cases/vendors/somename/some.name.test.php', $result['testFile']);

		$result = testCase('vendors/shells/sample.php');
		$this->assertEquals('app', $result['category']);
		$this->assertEquals('shells/sample', $result['case']);
		$this->assertEquals('tests/cases/vendors/shells/sample.test.php', $result['testFile']);

		$result = testCase('vendors/Test/hello.php');
		$this->assertEquals('app', $result['category']);
		$this->assertEquals('vendors/Test/hello', $result['case']);
		$this->assertEquals('tests/cases/vendors/Test/hello.test.php', $result['testFile']);

		$result = testCase('vendors/Test/MyTest.php');
		$this->assertEquals('app', $result['category']);
		$this->assertEquals('vendors/Test/MyTest', $result['case']);
		$this->assertEquals('tests/cases/vendors/Test/MyTest.test.php', $result['testFile']);

		$result = testCase('vendors/welcome.php');
		$this->assertEquals('app', $result['category']);
		$this->assertEquals('vendors/welcome', $result['case']);
		$this->assertEquals('tests/cases/vendors/welcome.test.php', $result['testFile']);

		$result = testCase('vendors/sample/configure_test_vendor_sample.php');
		$this->assertEquals('app', $result['category']);
		$this->assertEquals('vendors/sample/configure_test_vendor_sample', $result['case']);
		$this->assertEquals('tests/cases/vendors/sample/configure_test_vendor_sample.test.php', $result['testFile']);

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

		$result = testCase('plugins/test_plugin/vendors/welcome.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('vendors/welcome', $result['case']);
		$this->assertEquals('plugins/test_plugin/tests/cases/vendors/welcome.test.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/vendors/sample/sample_plugin.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('vendors/sample/sample_plugin', $result['case']);
		$this->assertEquals('plugins/test_plugin/tests/cases/vendors/sample/sample_plugin.test.php', $result['testFile']);

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
}
