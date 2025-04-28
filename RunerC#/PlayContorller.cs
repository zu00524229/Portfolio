using System.Collections;
using System.Collections.Generic;
using TMPro;
using UnityEngine;
using UnityEngine.InputSystem;
using UnityEngine.UI;
using UnityEngine.UIElements;
using UnityEngine.SceneManagement;
using Unity.VisualScripting;

public class PlayerController : MonoBehaviour
{
    public GameObject playButton; // 用於控制開始按鈕的顯示
    [SerializeField] GameObject BackgrounMusic;
    [SerializeField] GameObject replayButton;

    public int Hp;
    [SerializeField] GameObject Hpbar;
    [SerializeField] Text scoreText;
    public AudioSource jumpAudioSource; // 用來播放跳躍音效
    public AudioSource loveAudioSource;  // 用來播放愛心音效
    public AudioSource rockAudioSource;  // 用來播放石頭音效
    public AudioSource gameOverAudioSource; // 遊戲結束音效來源


    int score;
    float scoreTime;
    public float moveSpeed = 6f; // 角色的移動速度   
    private float InputX; // 存儲玩家水平方向的輸入  
    private bool isFilp = false; // 用來追蹤角色是否已經翻轉
    private bool isGrounded = false;  // 用來判斷角色是否在地面上
    // private bool canAttack = true;      // 攻擊
    // private bool isAttacking = false; // 新增：用來判斷角色是否在攻擊中


    // Dash 相關變數
    public float dashSpeed = 6f;  // Dash 移動速度
    public float dashDuration = 0.5f;  // Dash 持續時間
    private float dashTime = 0f;  // Dash 已經持續的時間
    private bool isDashing = false;  // 是否正在 Dash
    private bool canDash = true;  // 是否能 Dash
    public float dashCooldown = 0.3f;  // Dash 冷卻時間

    private Rigidbody2D rig; // Rigidbody2D 組件，用來控制物理行為
    private Animator ani; // Animator 組件，用來控制角色動畫

    public Transform groundpoint; // 用來檢測角色是否在地面上的位置   
    public LayerMask groundMask; // 用來設置檢測地面的層級，只有與這些層級重疊的物體會被視為地面 





    // Start 是在遊戲開始時調用，用來初始化角色的組件
    public void Start()
    {
        // 遊戲初始
        Time.timeScale = 0f; // 暫停遊戲
        playButton.SetActive(true); // 顯示 Play 按鈕

        Hp = 10;
        score = 0;
        scoreTime = 0;
        // 初始化組件
        rig = GetComponent<Rigidbody2D>();
        ani = GetComponent<Animator>();


    }

    // Update 每幀調用，用來更新角色的物理和動畫狀態
    public void Update()
    {

        if (isDashing)
        {
            rig.velocity = new Vector2(dashSpeed * InputX, 0);
            dashTime += Time.deltaTime;

            if (dashTime >= dashDuration)
            {
                isDashing = false;
                canDash = false;
                dashTime = 0f;
                ani.ResetTrigger("Dash"); // 重置 Dash 動畫 Trigger
                ani.SetBool("isRun", false); // 確保回到 Idle 或其他狀態
                StartCoroutine(DashCooldown());
            }
        }
        else
        {
            // 更新角色的水平移動速度，保持垂直速度不變（y 方向）
            rig.velocity = new Vector2(moveSpeed * InputX, rig.velocity.y);

            ani.SetBool("isRun", Mathf.Abs(rig.velocity.x) > 0); // 判斷角色是否在跑步並設定動畫   
            ani.SetBool("isGrounded", isGrounded); // 設定動畫參數，判斷角色是否站在地面上
            ani.SetFloat("yVelocity", rig.velocity.y); // 設定動畫參數，傳遞角色的垂直速度（y 軸）
        }


        if (!isFilp)
        {
            if (rig.velocity.x < 0)  // 如果角色向左移動
            {
                isFilp = true;
                transform.Rotate(0.0f, 180.0f, 0.0f);  // 翻轉角色
            }
        }
        else
        {
            if (rig.velocity.x > 0)  // 如果角色向右移動
            {
                isFilp = false;
                transform.Rotate(0.0f, 180.0f, 0.0f);  // 恢復角色的原始方向
            }
        }
        // 使用射線檢測來判斷角色是否站在地面上
        isGrounded = Physics2D.OverlapCircle(groundpoint.position, .3f, groundMask);
        // canAttack = isGrounded;   // 攻擊系統
        // 每 2 秒自動增加分數
        scoreTime += Time.deltaTime;
        if (scoreTime > 2f)
        {
            UpdateScore(1000);  // 每 2 秒增加1000分
            scoreTime = 0f;    // 重置計時器
        }

    }
    public void StartGame()
    {
        Time.timeScale = 1f; // 恢復遊戲
        playButton.SetActive(false); // 隱藏 Play 按鈕
        BackgrounMusic.gameObject.SetActive(true); // 顯示背景音樂


    }

    // // 攻擊系統
    // public void Attack(InputAction.CallbackContext context)
    // {
    //     // 檢查玩家是否可以攻擊
    //     if (canAttack)
    //     {
    //         isAttacking = true; // 設置為攻擊中狀態
    //         ani.SetBool("attack", true);
    //     }
    // }

    // public void EndAttack()
    // {
    //     ani.SetBool("attack", false);
    //     isAttacking = false; // 結束攻擊狀態
    // }

    public void Move(InputAction.CallbackContext context)
    {
        InputX = context.ReadValue<Vector2>().x; // 讀取水平方向的輸入
    }

    public void Jump(InputAction.CallbackContext context)
    {

        if (isGrounded) // 只有當角色站在地面上時才允許跳躍
        {
            rig.velocity = new Vector2(rig.velocity.x, 8);  // 施加跳躍速度

            // 播放跳躍音效
            if (jumpAudioSource != null)
            {
                jumpAudioSource.Play();  // 播放音效
            }
        }
    }



    // Dash 函數
    public void Dash(InputAction.CallbackContext context)
    {
        if (canDash && isGrounded)
        {
            isDashing = true;  // 開始 Dash
            ani.SetTrigger("Dash"); // 播放 Dash 動畫，只觸發一次

        }
    }

    // Dash 冷卻時間
    private IEnumerator DashCooldown()
    {
        yield return new WaitForSeconds(dashCooldown);
        canDash = true;  // Dash 冷卻完畢
    }

    // 用來在場景視圖中顯示角色的地面檢測範圍
    private void OnDrawGizmos()
    {
        Gizmos.DrawWireSphere(groundpoint.position, .3f);  // 繪製地面檢測範圍
    }

    void ModifyHp(int num)
    {
        Hp += num;
        if (Hp > 10)
        {
            Hp = 10;
        }
        else if (Hp <= 0)
        {
            Hp = 0;
            Die();
        }
        UpdateHpBar();  // 當血量有改變時，執行此方法來更新UI顯示
    }

    // 控制HpBar的顯示
    void UpdateHpBar()
    {
        for (int i = 0; i < Hpbar.transform.childCount; i++)
        {
            if (Hp > i)
            {
                Hpbar.transform.GetChild(i).gameObject.SetActive(true);
            }
            else
            {
                Hpbar.transform.GetChild(i).gameObject.SetActive(false);

            }
        }
    }


    // 用來觸發love or rock 碰撞事件
    void OnTriggerEnter2D(Collider2D other)
    {
        if (other.CompareTag("love"))
        {
            ModifyHp(1);  // 回復血量
            Destroy(other.gameObject);  // 摧毀碰到的愛心物品
            UpdateScore(450);
            if (loveAudioSource != null && !loveAudioSource.isPlaying)  // 確保音效源沒有正在播放
            {
                loveAudioSource.Play();  // 播放愛心音效
            }

        }
        else if (other.CompareTag("rock"))
        {
            ModifyHp(-3);  // 扣除血量
            Destroy(other.gameObject);  // 摧毀碰到的石頭物品
            UpdateScore(-500);
            if (rockAudioSource != null && !rockAudioSource.isPlaying)  // 確保音效源沒有正在播放
            {
                rockAudioSource.Play();  // 播放石頭音效
            }
        }
        else if (other.CompareTag("wood"))
        {
            ModifyHp(-5);  // 扣除血量
            UpdateScore(-1000);
            Destroy(other.gameObject);
        }
    }

    // 分數UI
    void UpdateScore(int scoreChange)
    {
        score += scoreChange;  // 更新分數
        score = Mathf.Max(score, 0);  // 確保分數不會低於 0
        scoreText.text = "分數:" + score.ToString("D7");  // 格式化為 7 位數顯示
    }

    void Die()
    {
        Time.timeScale = 0f;
        replayButton.SetActive(true);
        gameOverAudioSource.Play();     // 播放遊戲結束音效
        BackgrounMusic.gameObject.SetActive(false); // 顯示背景音樂


    }

    public void Replay()
    {
        Time.timeScale = 1f;
        SceneManager.LoadScene("SampleScene");
        BackgrounMusic.gameObject.SetActive(true); // 顯示背景音樂


    }
}
