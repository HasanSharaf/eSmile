DELIMITER //
create trigger quotation_user_insert after INSERT on soggetti for each row
begin
     insert into planner_synchronize set process_id=NEW.ID  ,process_type='user',process_table='soggetti';

   
end;//


DELIMITER //
create trigger quotation_payment_method_insert after INSERT on codiva for each row
begin
     insert into planner_synchronize set process_id=NEW.IDcodiva  ,process_type='payment_method', process_table='codiva';

   
end;//