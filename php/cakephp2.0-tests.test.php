<?php
define('RUNNING_TESTS', true);
require __DIR__ . '/cakephp2.0-tests.php';

class Cakephp20HookTest extends PHPUnit_Framework_TestCase {

	function testNonPhpFiles() {

		$result = testCase('noextension');
		$this->assertFalse($result);

		$result = testCase('some.sh');
		$this->assertFalse($result);

		$result = testCase('textfile.txt');
		$this->assertFalse($result);

	}

	function testAppFiles() {

		$result = testCase('View/Helper/BananaHelper.php');
		$this->assertEquals('app', $result['category']);
		$this->assertEquals('View/Helper/BananaHelper', $result['case']);
		$this->assertEquals('tests/Case/View/Helper/BananaHelperTest.php', $result['testFile']);

		$result = testCase('Lib/Cache/Engine/TestAppCacheEngine.php');
		$this->assertEquals('app', $result['category']);
		$this->assertEquals('Lib/Cache/Engine/TestAppCacheEngine', $result['case']);
		$this->assertEquals('tests/Case/Lib/Cache/Engine/TestAppCacheEngineTest.php', $result['testFile']);

		$result = testCase('Lib/Utility/TestUtilityClass.php');
		$this->assertEquals('app', $result['category']);
		$this->assertEquals('Lib/Utility/TestUtilityClass', $result['case']);
		$this->assertEquals('tests/Case/Lib/Utility/TestUtilityClassTest.php', $result['testFile']);

		$result = testCase('Lib/Library.php');
		$this->assertEquals('app', $result['category']);
		$this->assertEquals('Lib/Library', $result['case']);
		$this->assertEquals('tests/Case/Lib/LibraryTest.php', $result['testFile']);

		$result = testCase('Lib/Log/Engine/TestAppLog.php');
		$this->assertEquals('app', $result['category']);
		$this->assertEquals('Lib/Log/Engine/TestAppLog', $result['case']);
		$this->assertEquals('tests/Case/Lib/Log/Engine/TestAppLogTest.php', $result['testFile']);

		$result = testCase('Controller/TestsAppsController.php');
		$this->assertEquals('app', $result['category']);
		$this->assertEquals('Controller/TestsAppsController', $result['case']);
		$this->assertEquals('tests/Case/Controller/TestsAppsControllerTest.php', $result['testFile']);

		$result = testCase('Controller/TestsAppsPostsController.php');
		$this->assertEquals('app', $result['category']);
		$this->assertEquals('Controller/TestsAppsPostsController', $result['case']);
		$this->assertEquals('tests/Case/Controller/TestsAppsPostsControllerTest.php', $result['testFile']);

		$result = testCase('Console/Command/SampleShell.php');
		$this->assertEquals('app', $result['category']);
		$this->assertEquals('Console/Command/SampleShell', $result['case']);
		$this->assertEquals('tests/Case/Console/Command/SampleShellTest.php', $result['testFile']);

		$result = testCase('Console/templates/test/classes/test_object.ctp');
		$this->assertFalse($result);

		$result = testCase('Model/PersisterTwo.php');
		$this->assertEquals('app', $result['category']);
		$this->assertEquals('Model/PersisterTwo', $result['case']);
		$this->assertEquals('tests/Case/Model/PersisterTwoTest.php', $result['testFile']);

		$result = testCase('Model/PersisterOne.php');
		$this->assertEquals('app', $result['category']);
		$this->assertEquals('Model/PersisterOne', $result['case']);
		$this->assertEquals('tests/Case/Model/PersisterOneTest.php', $result['testFile']);

		$result = testCase('Model/Comment.php');
		$this->assertEquals('app', $result['category']);
		$this->assertEquals('Model/Comment', $result['case']);
		$this->assertEquals('tests/Case/Model/CommentTest.php', $result['testFile']);

		$result = testCase('Model/Post.php');
		$this->assertEquals('app', $result['category']);
		$this->assertEquals('Model/Post', $result['case']);
		$this->assertEquals('tests/Case/Model/PostTest.php', $result['testFile']);

		$result = testCase('Model/Behavior/PersisterTwoBehaviorBehavior.php');
		$this->assertEquals('app', $result['category']);
		$this->assertEquals('Model/Behavior/PersisterTwoBehaviorBehavior', $result['case']);
		$this->assertEquals('tests/Case/Model/Behavior/PersisterTwoBehaviorBehaviorTest.php', $result['testFile']);

		$result = testCase('Model/Behavior/PersisterOneBehaviorBehavior.php');
		$this->assertEquals('app', $result['category']);
		$this->assertEquals('Model/Behavior/PersisterOneBehaviorBehavior', $result['case']);
		$this->assertEquals('tests/Case/Model/Behavior/PersisterOneBehaviorBehaviorTest.php', $result['testFile']);

		$result = testCase('Model/Datasource/Session/TestAppLibSession.php');
		$this->assertEquals('app', $result['category']);
		$this->assertEquals('Model/Datasource/Session/TestAppLibSession', $result['case']);
		$this->assertEquals('tests/Case/Model/Datasource/Session/TestAppLibSessionTest.php', $result['testFile']);

		$result = testCase('Model/Datasource/Test2Source.php');
		$this->assertEquals('app', $result['category']);
		$this->assertEquals('Model/Datasource/Test2Source', $result['case']);
		$this->assertEquals('tests/Case/Model/Datasource/Test2SourceTest.php', $result['testFile']);

		$result = testCase('Model/Datasource/Database/TestLocalDriver.php');
		$this->assertEquals('app', $result['category']);
		$this->assertEquals('Model/Datasource/Database/TestLocalDriver', $result['case']);
		$this->assertEquals('tests/Case/Model/Datasource/Database/TestLocalDriverTest.php', $result['testFile']);

		$result = testCase('Model/Datasource/Test2OtherSource.php');
		$this->assertEquals('app', $result['category']);
		$this->assertEquals('Model/Datasource/Test2OtherSource', $result['case']);
		$this->assertEquals('tests/Case/Model/Datasource/Test2OtherSourceTest.php', $result['testFile']);

	}

	function testPluginFiles() {

		$result = testCase('plugins/test_plugin_two/Console/Command/example.php');
		$this->assertEquals('test_plugin_two', $result['category']);
		$this->assertEquals('Console/Command/example', $result['case']);
		$this->assertEquals('plugins/test_plugin_two/tests/Case/Console/Command/exampleTest.php', $result['testFile']);

		$result = testCase('plugins/test_plugin_two/Console/Command/welcome.php');
		$this->assertEquals('test_plugin_two', $result['category']);
		$this->assertEquals('Console/Command/welcome', $result['case']);
		$this->assertEquals('plugins/test_plugin_two/tests/Case/Console/Command/welcomeTest.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/config/schema/schema.php');
		$this->assertFalse($result);

		$result = testCase('plugins/test_plugin/config/load.php');
		$this->assertFalse($result);

		$result = testCase('plugins/test_plugin/config/more.load.php');
		$this->assertFalse($result);

		$result = testCase('plugins/test_plugin/View/layouts/default.ctp');
		$this->assertFalse($result);

		$result = testCase('plugins/test_plugin/View/Helper/OtherHelperHelper.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('View/Helper/OtherHelperHelper', $result['case']);
		$this->assertEquals('plugins/test_plugin/tests/Case/View/Helper/OtherHelperHelperTest.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/View/Helper/test_plugin_app.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('View/Helper/test_plugin_app', $result['case']);
		$this->assertEquals('plugins/test_plugin/tests/Case/View/Helper/test_plugin_appTest.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/View/Helper/plugged_helper.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('View/Helper/plugged_helper', $result['case']);
		$this->assertEquals('plugins/test_plugin/tests/Case/View/Helper/plugged_helperTest.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/View/tests/scaffold.form.ctp');
		$this->assertFalse($result);

		$result = testCase('plugins/test_plugin/View/tests/index.ctp');
		$this->assertFalse($result);

		$result = testCase('plugins/test_plugin/View/elements/plugin_element.ctp');
		$this->assertFalse($result);

		$result = testCase('plugins/test_plugin/View/elements/test_plugin_element.ctp');
		$this->assertFalse($result);

		$result = testCase('plugins/test_plugin/Lib/test_plugin_library.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('Lib/test_plugin_library', $result['case']);
		$this->assertEquals('plugins/test_plugin/tests/Case/Lib/test_plugin_libraryTest.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/Lib/Cache/Engine/TestPluginCacheEngine.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('Lib/Cache/Engine/TestPluginCacheEngine', $result['case']);
		$this->assertEquals('plugins/test_plugin/tests/Case/Lib/Cache/Engine/TestPluginCacheEngineTest.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/Lib/Custom/Package/CustomLibClass.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('Lib/Custom/Package/CustomLibClass', $result['case']);
		$this->assertEquals('plugins/test_plugin/tests/Case/Lib/Custom/Package/CustomLibClassTest.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/Lib/Error/TestPluginExceptionRenderer.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('Lib/Error/TestPluginExceptionRenderer', $result['case']);
		$this->assertEquals('plugins/test_plugin/tests/Case/Lib/Error/TestPluginExceptionRendererTest.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/Lib/Log/Engine/TestPluginLog.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('Lib/Log/Engine/TestPluginLog', $result['case']);
		$this->assertEquals('plugins/test_plugin/tests/Case/Lib/Log/Engine/TestPluginLogTest.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/Controller/test_plugin_app_controller.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('Controller/test_plugin_app_controller', $result['case']);
		$this->assertEquals('plugins/test_plugin/tests/Case/Controller/test_plugin_app_controllerTest.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/Controller/Component/test_plugin_other_component.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('Controller/Component/test_plugin_other_component', $result['case']);
		$this->assertEquals('plugins/test_plugin/tests/Case/Controller/Component/test_plugin_other_componentTest.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/Controller/Component/other_component.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('Controller/Component/other_component', $result['case']);
		$this->assertEquals('plugins/test_plugin/tests/Case/Controller/Component/other_componentTest.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/Controller/Component/plugins_component.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('Controller/Component/plugins_component', $result['case']);
		$this->assertEquals('plugins/test_plugin/tests/Case/Controller/Component/plugins_componentTest.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/Controller/Component/test_plugin_component.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('Controller/Component/test_plugin_component', $result['case']);
		$this->assertEquals('plugins/test_plugin/tests/Case/Controller/Component/test_plugin_componentTest.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/Controller/test_plugin_controller.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('Controller/test_plugin_controller', $result['case']);
		$this->assertEquals('plugins/test_plugin/tests/Case/Controller/test_plugin_controllerTest.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/Controller/tests_controller.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('Controller/tests_controller', $result['case']);
		$this->assertEquals('plugins/test_plugin/tests/Case/Controller/tests_controllerTest.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/Console/Command/example.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('Console/Command/example', $result['case']);
		$this->assertEquals('plugins/test_plugin/tests/Case/Console/Command/exampleTest.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/Console/Command/Task/other_task.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('Console/Command/Task/other_task', $result['case']);
		$this->assertEquals('plugins/test_plugin/tests/Case/Console/Command/Task/other_taskTest.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/Model/test_plugin_auth_user.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('Model/test_plugin_auth_user', $result['case']);
		$this->assertEquals('plugins/test_plugin/tests/Case/Model/test_plugin_auth_userTest.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/Model/test_plugin_app_model.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('Model/test_plugin_app_model', $result['case']);
		$this->assertEquals('plugins/test_plugin/tests/Case/Model/test_plugin_app_modelTest.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/Model/TestPluginPost.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('Model/TestPluginPost', $result['case']);
		$this->assertEquals('plugins/test_plugin/tests/Case/Model/TestPluginPostTest.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/Model/test_plugin_authors.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('Model/test_plugin_authors', $result['case']);
		$this->assertEquals('plugins/test_plugin/tests/Case/Model/test_plugin_authorsTest.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/Model/Behavior/test_plugin_persister_one.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('Model/Behavior/test_plugin_persister_one', $result['case']);
		$this->assertEquals('plugins/test_plugin/tests/Case/Model/Behavior/test_plugin_persister_oneTest.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/Model/Behavior/test_plugin_persister_two.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('Model/Behavior/test_plugin_persister_two', $result['case']);
		$this->assertEquals('plugins/test_plugin/tests/Case/Model/Behavior/test_plugin_persister_twoTest.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/Model/Datasource/TestSource.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('Model/Datasource/TestSource', $result['case']);
		$this->assertEquals('plugins/test_plugin/tests/Case/Model/Datasource/TestSourceTest.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/Model/Datasource/Session/TestPluginSession.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('Model/Datasource/Session/TestPluginSession', $result['case']);
		$this->assertEquals('plugins/test_plugin/tests/Case/Model/Datasource/Session/TestPluginSessionTest.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/Model/Datasource/test_other_source.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('Model/Datasource/test_other_source', $result['case']);
		$this->assertEquals('plugins/test_plugin/tests/Case/Model/Datasource/test_other_sourceTest.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/Model/Datasource/Database/DboDummy.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('Model/Datasource/Database/DboDummy', $result['case']);
		$this->assertEquals('plugins/test_plugin/tests/Case/Model/Datasource/Database/DboDummyTest.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/Model/Datasource/Database/TestDriver.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('Model/Datasource/Database/TestDriver', $result['case']);
		$this->assertEquals('plugins/test_plugin/tests/Case/Model/Datasource/Database/TestDriverTest.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/Model/test_plugin_comment.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('Model/test_plugin_comment', $result['case']);
		$this->assertEquals('plugins/test_plugin/tests/Case/Model/test_plugin_commentTest.php', $result['testFile']);

	}

	function testCoreFiles() {
	}
}
