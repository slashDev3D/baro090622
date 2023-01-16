/**
 * @author https://www.cosmosfarm.com/
 */

function kboard_inside_ask_category_update(content_uid, new_category){
	kboard_content_update(content_uid, {category2:new_category}, function(res){
		if(res.result == 'success'){
			alert('변경되었습니다.');
		}
		else{
			alert(res.message);
		}
	});
}