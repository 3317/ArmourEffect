<?php
/*		Iron	Gold	Diamond
Sword	267		283		276
Shovel	256		284		277
Pickaxe	257		285		278
Axe		258		286		279
Hoe		292		294		293		*/

namespace f3317\ArmourEffect;

use pocketmine\Player;
use pocketmine\Server;
use pocketmine\block\Block;
use pocketmine\command\Command;
use pocketmine\command\Commandvictim;
use pocketmine\command\ConsoleCommandvictim;
use pocketmine\entity\Entity;
use pocketmine\entity\Effect;
use pocketmine\event\Listener;
use pocketmine\event\PlayerRespawnEvent;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageByBlockEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDeathEvent;
use pocketmine\event\entity\EntityRegainHealthEvent;
use pocketmine\event\entity\EntitySpawnEvent;
use pocketmine\event\entity\ExplosionPrimeEvent;
use pocketmine\entity\Living;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerItemHeldEvent;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\inventory\PlayerInventory;
use pocketmine\item\Tool;
use pocketmine\item\Item;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\level\Level;
use pocketmine\level\format\FullChunk;
use pocketmine\level\Explosion;
use pocketmine\level\Position;
use pocketmine\math\Vector3;
use pocketmine\nbt\NBT;
use pocketmine\nbt\tag\Compound;
use pocketmine\nbt\tag\DoubleTag;
use pocketmine\nbt\tag\Enum;
use pocketmine\nbt\tag\FloatTag;
use pocketmine\nbt\tag\ShortTag;
use pocketmine\nbt\tag\StringTag;
use pocketmine\nbt\tag\ByteTag;
use pocketmine\network\protocol\AddEntityPacket;
use pocketmine\network\protocol\SetEntityDataPacket;
use pocketmine\plugin\PluginBase;
use pocketmine\tile\Tile;
use pocketmine\tile\Sign;
use pocketmine\utils\TextFormat;
use pocketmine\utils\Config;
use pocketmine\block\Fire;


class Main extends PluginBase implements Listener
{
	public function onEnable()
    {
	$plugin = "Armour Effect";
	$this->getLogger()->info(TextFormat::GREEN.$plugin." is Active!");
	$this->getServer()->getPluginManager()->registerEvents($this, $this);
    }
	
	public function onBlockTap(PlayerInteractEvent $event)
	{
	$player = $event->getPlayer();
	$id = $player->getInventory()->getItemInHand()->getId();
		if($id == 256)
		{
			$player = $event->getPlayer();
			$Item = Item::get(256);
			$player->getInventory()->addItem(Item::get(3, 0, 32));
			$player->getInventory()->removeItem($Item);
			$player->getInventory()->addItem(Item::get(269));
			$player->sendMessage("[AE] SUCCESS");
	
		}
		if($id == 257)
		{
			$player = $event->getPlayer();
			$Item = Item::get(257);
			$player->getInventory()->addItem(Item::get(4, 0, 32));
			$player->getInventory()->removeItem($Item);
			$player->getInventory()->addItem(Item::get(270));
			$player->sendMessage("[AE] SUCCESS");
	
		}
		if($id == 258)
		{
			$player = $event->getPlayer();
			$Item = Item::get(258);
			$player->getInventory()->addItem(Item::get(5, 0, 32));
			$player->getInventory()->removeItem($Item);
			$player->getInventory()->addItem(Item::get(271));
			$player->sendMessage("[AE] SUCCESS");
		}
		if($id == 292)
		{
			$player = $event->getPlayer();
			$Item = Item::get(292);
			$player->setHealth(20);
			$player->getInventory()->removeItem($Item);
			$player->getInventory()->addItem(Item::get(290));
			$player->sendMessage("[AE] SUCCESS");
	
		}
		if($id == 267)
		{
			$Block = $event->getBlock();
			$item = Item::get(267);
			$level = $player->getLevel(); 
			$vector = new Vector3($Block->getX(),$Block->getY(),$Block->getZ());
			$level->setBlock(new Vector3($Block->getX(),$Block->getY()+1,$Block->getZ()), Block::get(51));
			$player->getInventory()->removeItem($item);
			$player->getInventory()->addItem(Item::get(268));
			$player->sendMessage("[AE] SUCCESS");
		}
		if($id == 284)
		{
			$player = $event->getPlayer();
			$Item = Item::get(284);
			$player->addEffect(Effect::getEffect(Effect::SPEED)->setAmplifier(2)->setDuration(3*20));
			$player->getInventory()->removeItem($Item);
			$player->getInventory()->addItem(Item::get(269));
			$player->sendMessage("[AE] SUCCESS");
	
		}
		if($id == 285)
		{
			$Block = $event->getBlock();
			$player = $event->getPlayer();
			$Item = Item::get(285);
			$level = $player->getLevel(); 
			$vector = new Vector3($Block->getX(),$Block->getY(),$Block->getZ());
			$explosion = new Explosion(new Position($Block->getX(),$Block->getY(),$Block->getZ(),$level), 3); 
			$player->addEffect(Effect::getEffect(Effect::DAMAGE_RESISTANCE)->setAmplifier(4)->setDuration(2*20));
			$explosion->explode();
			//$player->callEvent($ev = new ExplosionPrimeEvent($player, 4));
			$player->getInventory()->removeItem($Item);
			$player->getInventory()->addItem(Item::get(270));
			$player->sendMessage("[AE] SUCCESS");
	
		}
		if($id == 286)
		{

			$Block = $event->getBlock();
			$player = $event->getPlayer();
			$Item = Item::get(286);
			$level = $player->getLevel(); 
			$vector = new Vector3($Block->getX(),$Block->getY(),$Block->getZ());
			$level->setBlock(new Vector3($Block->getX()+1,$Block->getY()-1,$Block->getZ()-1), Block::get(0));
			$level->setBlock(new Vector3($Block->getX()+1,$Block->getY()-1,$Block->getZ()+1), Block::get(0));
			$level->setBlock(new Vector3($Block->getX()+1,$Block->getY()-1,$Block->getZ()), Block::get(0));
			$level->setBlock(new Vector3($Block->getX(),$Block->getY()-1,$Block->getZ()-1), Block::get(0));
			$level->setBlock(new Vector3($Block->getX(),$Block->getY()-1,$Block->getZ()+1), Block::get(0));
			$level->setBlock(new Vector3($Block->getX(),$Block->getY()-1,$Block->getZ()), Block::get(0));
			$level->setBlock(new Vector3($Block->getX()-1,$Block->getY()-1,$Block->getZ()-1), Block::get(0));
			$level->setBlock(new Vector3($Block->getX()-1,$Block->getY()-1,$Block->getZ()+1), Block::get(0));
			$level->setBlock(new Vector3($Block->getX()-1,$Block->getY()-1,$Block->getZ()), Block::get(0));

			$level->setBlock(new Vector3($Block->getX()+1,$Block->getY(),$Block->getZ()-1), Block::get(0));
			$level->setBlock(new Vector3($Block->getX()+1,$Block->getY(),$Block->getZ()+1), Block::get(0));
			$level->setBlock(new Vector3($Block->getX()+1,$Block->getY(),$Block->getZ()), Block::get(0));
			$level->setBlock(new Vector3($Block->getX(),$Block->getY(),$Block->getZ()-1), Block::get(0));
			$level->setBlock(new Vector3($Block->getX(),$Block->getY(),$Block->getZ()+1), Block::get(0));
			$level->setBlock(new Vector3($Block->getX(),$Block->getY(),$Block->getZ()), Block::get(0));
			$level->setBlock(new Vector3($Block->getX()-1,$Block->getY(),$Block->getZ()-1), Block::get(0));
			$level->setBlock(new Vector3($Block->getX()-1,$Block->getY(),$Block->getZ()+1), Block::get(0));
			$level->setBlock(new Vector3($Block->getX()-1,$Block->getY(),$Block->getZ()), Block::get(0));			
			
			$level->setBlock(new Vector3($Block->getX()+1,$Block->getY()+1,$Block->getZ()-1), Block::get(0));
			$level->setBlock(new Vector3($Block->getX()+1,$Block->getY()+1,$Block->getZ()+1), Block::get(0));
			$level->setBlock(new Vector3($Block->getX()+1,$Block->getY()+1,$Block->getZ()), Block::get(0));
			$level->setBlock(new Vector3($Block->getX(),$Block->getY()+1,$Block->getZ()-1), Block::get(0));
			$level->setBlock(new Vector3($Block->getX(),$Block->getY()+1,$Block->getZ()+1), Block::get(0));
			$level->setBlock(new Vector3($Block->getX(),$Block->getY()+1,$Block->getZ()), Block::get(0));
			$level->setBlock(new Vector3($Block->getX()-1,$Block->getY()+1,$Block->getZ()-1), Block::get(0));
			$level->setBlock(new Vector3($Block->getX()-1,$Block->getY()+1,$Block->getZ()+1), Block::get(0));
			$level->setBlock(new Vector3($Block->getX()-1,$Block->getY()+1,$Block->getZ()), Block::get(0));
			$Item = Item::get(286);
			$player->getInventory()->removeItem($Item);
			$player->getInventory()->addItem(Item::get(271));
			$player->sendMessage("[AE] SUCCESS");
	
		}
		if($id == 294)
		{
			$player = $event->getPlayer();
			$Item = Item::get(294);
			$player->addEffect(Effect::getEffect(Effect::INVISIBILITY)->setAmplifier(2)->setDuration(5*20));
			$player->getInventory()->removeItem($Item);
			$player->getInventory()->addItem(Item::get(290));
			$player->sendMessage("[AE] SUCCESS");
		}
		if($id == 277)
		{
			$player = $event->getPlayer();
			$Item = Item::get(277);
			//ここらへんに実行するやつ
			$player->getInventory()->removeItem($Item);
			$player->getInventory()->addItem(Item::get(269));
			$player->sendMessage("[AE] SUCCESS");
	
		}
		if($id == 278)
		{
			$player = $event->getPlayer();
			$Item = Item::get(278);
			//ここらへんに実行するやつ
			$player->getInventory()->removeItem($Item);
			$player->getInventory()->addItem(Item::get(270));
			$player->sendMessage("[AE] SUCCESS");
	
		}
		if($id == 279)
		{
			$player = $event->getPlayer();
			$Item = Item::get(279);
			//ここらへんに実行するやつ
			$player->getInventory()->removeItem($Item);
			$player->getInventory()->addItem(Item::get(271));
			$player->sendMessage("[AE] SUCCESS");
	
		}
		if($id == 293)
		{
			$player = $event->getPlayer();
			$Item = Item::get(279);
			//ここらへんに実行するやつ
			$player->getInventory()->removeItem($Item);
			$player->getInventory()->addItem(Item::get(290));
			$player->sendMessage("[AE] SUCCESS");
	
		}
		return false; 
	}
	
	
	public function onAttack(EntityDamageEvent $event)
	{
		if($event instanceof EntityDamageByEntityEvent)
		{
			if($event->getEntity() instanceof Player)
			{
			$attacker = $event->getDamager();
			$id = $attacker->getInventory()->getItemInHand()->getId();
				if($id == 283)
				{
					$player = $event->getPlayer();
					$Item = Item::get(283);
					$player->addEffect(Effect::getEffect(Effect::STRENGTH)->setAmplifier(2)->setDuration(3*20));
					$player->getInventory()->removeItem($Item);
					$player->sendMessage("[AE] SUCCESS");
				}
				if($id == 276)
				{
					$player = $event->getPlayer();
					$victim = $event->getEntity();
					$Item = Item::get(276);
					$player->onEntityCollide();
					$victim->addEffect(Effect::getEffect(Effect::BLINDNESS)->setAmplifier(2)->setDuration(4*20));
					$player->getInventory()->removeItem($Item);
					$player->sendMessage("[AE] SUCCESS");
				}
			}
		}
	}
}
    /*	
    public function onEnable()
    {
        $this->getLogger()->info("Armour Effect is Active!");
    }

    public function onSpawn(PlayerRespawnEvent $event)
    {
        $p = $event->getPlayer();
        for($i = 0; $i <= 3; $i++)
        {
            if($p->getInventory()->getArmorItem($i)->getID() == 0)
            {
            }
        }
    }
	
}
public function onEnable(){
     $this->loadYml();
     }

     public function onCommand(Commandvictim $victim, Command $cmd, $label, array $sub)
	 
	 {
     $n = $victim->getName();
     $m = "[ToggleInventory] ";
     if($n == "CONSOLE"){
     $victim->sendMessage("Please run this command in-game");
     return true;
     }
     $getInv = [];
     $inv = $victim->getInventory();
     if(!isset($this->si[$n])) $this->si[$n] = [];
     $getInv = [];
     foreach($inv->getContents() as $gI){
     if($gI->getID() !== 0 and $gI->getCount() > 0) $getInv[] = [$gI->getID(),$gI->getDamage(),$gI->getCount() ];
     }
     $setInv = [];
     foreach($this->si[$n] as $sI)
     $setInv[] = Item::get($sI[0], $sI[1], $sI[2]);
     $this->si[$n] = $getInv;
     $inv->setContents($setInv);
     $this->saveYml();
     $victim->sendMessage("§2 インベントリを切り替えました");
     return true;
     }

     public function loadYml(){
     @mkdir($this->getServer()->getDataPath() . "/plugins/ToggleInventory/");
     $this->subInventory = new Config($this->getServer()->getDataPath() . "/plugins/ToggleInventory/" . "ToggleInventory.yml", Config::YAML);
     $this->si = $this->subInventory->getAll();
     }

     public function saveYml(){
     asort($this->si);
     $this->subInventory->setAll($this->si);
     $this->subInventory->save();
     $this->loadYml();
     }
     */
?>