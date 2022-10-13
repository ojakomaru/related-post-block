import { registerBlockType } from "@wordpress/blocks";
import { withSelect, select } from "@wordpress/data";
import "./style.scss";
import Edit from "./edit";
registerBlockType("oja/oja-related-post-block", {
	title: "Oja Related Post Block",
	description: "関連記事を選択しブロックとして表示します",
	category: "common",
	icon: "smiley",
	supports: {
		html: false,
	},
	edit: withSelect((select, props) => {
		//現在の投稿の post ID を取得
		const currentPostId = select("core/editor").getCurrentPostId(),
    //現在の投稿タイプ名を取得
    curentPostType = select("core/editor").getCurrentPostType();
		//クエリパラメータ
		const query = {
			per_page: -1,
			order: "desc",
			status: "publish",
			exclude: currentPostId, //現在の投稿は除外
		};
		return {
			posts: select("core").getEntityRecords("postType", curentPostType, query),
		};
	})(Edit),
	save: () => {
		return null;
	},
});
