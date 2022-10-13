import { SelectControl } from "@wordpress/components";
import ServerSideRender from "@wordpress/server-side-render";
import { getInspectorControls } from "./components/getInspectorControls";
import "./editor.scss";

export default function Edit(props) {
	const {
		attributes: {selectedPostId, label, isTimeStamp, postDesign },
		className,
		setAttributes,
    posts
	} = props;

  let select_options = [];
	if (posts) {
		select_options.push({ value: 0, label: "投稿を選択" });
		posts.forEach((post) => {
			select_options.push({ value: post.id, label: post.title.rendered });
		});
	} else {
		select_options.push({ value: 0, label: "読み込み中" });
	}
	return [
		getInspectorControls(props),
		<div className={className}>
			<SelectControl
				label="投稿セレクトメニュー" //セレクトメニューのラベル
				options={select_options}
				value={selectedPostId}
				onChange={(newId) => setAttributes({ selectedPostId: parseInt(newId) })}
			/>
		</div>,
		<ServerSideRender
			block={props.name}
			attributes={{
				selectedPostId: selectedPostId,
				postDesign: postDesign,
				label: label,
				isTimeStamp: isTimeStamp,
			}}
			className="oja-server-siderender" //ServerSideRender 用のクラスを追加
		/>,
	];
}
